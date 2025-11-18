<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GroceryItem;
use Illuminate\Support\Facades\Auth;

class GroceryList extends Component
{
    public $items;
    public $newItemName = '';
    public $newItemQuantity = 1;
    public $newItemPrice = '';
    public $newItemBrand = '';
    public $newItemStore = '';
    
    public $editingItemId = null;
    public $editItemName = '';
    public $editItemQuantity = 1;
    public $editItemPrice = '';
    public $editItemBrand = '';
    public $editItemStore = '';

    public function mount()
    {
        $this->loadItems();
    }

    public function loadItems()
    {
        $this->items = GroceryItem::where('user_id', Auth::id())->get();
    }

    public function addItem()
    {
        $this->validate([
            'newItemName' => 'required|min:2',
            'newItemQuantity' => 'required|integer|min:1',
            'newItemPrice' => 'nullable|numeric|min:0'
        ]);

        GroceryItem::create([
            'name' => $this->newItemName,
            'quantity' => $this->newItemQuantity,
            'price' => $this->newItemPrice ?: null,
            'category' => $this->newItemBrand,
            'store' => $this->newItemStore,
            'user_id' => Auth::id(),
        ]);

        $this->reset(['newItemName', 'newItemQuantity', 'newItemPrice', 'newItemBrand', 'newItemStore']);
        $this->loadItems();
    }

    public function startEdit($itemId)
    {
        $item = GroceryItem::where('user_id', Auth::id())->find($itemId);
        $this->editingItemId = $itemId;
        $this->editItemName = $item->name;
        $this->editItemQuantity = $item->quantity;
        $this->editItemPrice = $item->price;
        $this->editItemBrand = $item->category;
        $this->editItemStore = $item->store;
    }

    public function updateItem()
    {
        $this->validate([
            'editItemName' => 'required|min:2',
            'editItemQuantity' => 'required|integer|min:1',
            'editItemPrice' => 'nullable|numeric|min:0'
        ]);

        $item = GroceryItem::where('user_id', Auth::id())->find($this->editingItemId);
        $item->update([
            'name' => $this->editItemName,
            'quantity' => $this->editItemQuantity,
            'price' => $this->editItemPrice ?: null,
            'category' => $this->editItemBrand,
            'store' => $this->editItemStore,
        ]);

        $this->cancelEdit();
        $this->loadItems();
    }

    public function cancelEdit()
    {
        $this->editingItemId = null;
        $this->reset(['editItemName', 'editItemQuantity', 'editItemPrice', 'editItemBrand', 'editItemStore']);
    }

    public function togglePurchased($itemId)
    {
        $item = GroceryItem::where('user_id', Auth::id())->find($itemId);
        $item->update(['purchased' => !$item->purchased]);
        $this->loadItems();
    }

    public function deleteItem($itemId)
    {
        GroceryItem::where('user_id', Auth::id())->find($itemId)->delete();
        $this->loadItems();
    }

    public function getTotalEstimatedCostProperty()
    {
        return $this->items->sum('total');
    }

    public function render()
    {
        return view('livewire.grocery-list');
    }
}