<div class="max-w-4xl mx-auto p-6">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-orange-800 mb-2">Grocery Expense Tracker</h1>
        <div class="bg-orange-100 rounded-lg shadow-md p-4 inline-block border border-orange-200">
            <p class="text-lg font-semibold text-orange-900">
                Total Estimated Cost: 
                <span class="text-orange-600">R{{ number_format($this->totalEstimatedCost, 2) }}</span>
            </p>
        </div>
    </div>

    <!-- Add Item Form -->
    <div class="bg-orange-50 rounded-lg shadow-md p-6 mb-6 border border-orange-200">
        <h2 class="text-xl font-semibold mb-4 text-orange-800">Add New Item</h2>
        <form wire:submit.prevent="addItem" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-medium text-orange-700 mb-1">Item Name</label>
                <input type="text" wire:model="newItemName" 
                       class="w-full rounded-md border-orange-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 bg-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-orange-700 mb-1">Quantity</label>
                <input type="number" wire:model="newItemQuantity" min="1"
                       class="w-full rounded-md border-orange-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 bg-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-orange-700 mb-1">Price (R)</label>
                <input type="number" wire:model="newItemPrice" min="0" step="0.01"
                       class="w-full rounded-md border-orange-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 bg-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-orange-700 mb-1">Brand</label>
                <input type="text" wire:model="newItemBrand" 
                       class="w-full rounded-md border-orange-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 bg-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-orange-700 mb-1">Store</label>
                <input type="text" wire:model="newItemStore" 
                       class="w-full rounded-md border-orange-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 bg-white">
            </div>
            <div class="md:col-span-2 lg:col-span-5">
                <button type="submit" 
                        class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded transition duration-200">
                    Add Item
                </button>
            </div>
        </form>
    </div>

    <!-- Grocery List -->
    <div class="bg-orange-50 rounded-lg shadow-md border border-orange-200">
        <div class="p-4 border-b border-orange-200 bg-orange-100">
            <h2 class="text-xl font-semibold text-orange-800">Grocery List ({{ $items->count() }} items)</h2>
        </div>

        <!-- Edit Form -->
        @if($editingItemId)
        <div class="p-4 bg-amber-100 border-b border-amber-200">
            <h3 class="text-lg font-semibold mb-3 text-orange-800">Edit Item</h3>
            <form wire:submit.prevent="updateItem" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-medium text-orange-700 mb-1">Item Name</label>
                    <input type="text" wire:model="editItemName" 
                           class="w-full rounded-md border-orange-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 bg-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-orange-700 mb-1">Quantity</label>
                    <input type="number" wire:model="editItemQuantity" min="1"
                           class="w-full rounded-md border-orange-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 bg-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-orange-700 mb-1">Price (R)</label>
                    <input type="number" wire:model="editItemPrice" min="0" step="0.01"
                           class="w-full rounded-md border-orange-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 bg-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-orange-700 mb-1">Brand</label>
                    <input type="text" wire:model="editItemBrand" 
                           class="w-full rounded-md border-orange-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 bg-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-orange-700 mb-1">Store</label>
                    <input type="text" wire:model="editItemStore" 
                           class="w-full rounded-md border-orange-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 bg-white">
                </div>
                <div class="md:col-span-2 lg:col-span-5 flex space-x-2">
                    <button type="submit" 
                            class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                        Update
                    </button>
                    <button type="button" wire:click="cancelEdit"
                            class="bg-orange-300 hover:bg-orange-400 text-orange-800 font-bold py-2 px-4 rounded transition duration-200">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
        @endif

        <!-- Items List -->
        <ul class="divide-y divide-orange-200">
            @foreach($items as $item)
                <li class="p-4 hover:bg-orange-100 transition duration-150 {{ $item->purchased ? 'bg-green-100' : '' }}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4 flex-1">
                            <input type="checkbox" 
                                   wire:click="togglePurchased({{ $item->id }})"
                                   {{ $item->purchased ? 'checked' : '' }}
                                   class="h-5 w-5 text-orange-600 rounded focus:ring-orange-500">
                            
                            <div class="flex-1">
                                <div class="flex items-center space-x-3">
                                    <span class="{{ $item->purchased ? 'line-through text-orange-500' : 'text-orange-900 font-medium' }}">
                                        {{ $item->quantity }}x {{ $item->name }}
                                    </span>
                                    @if($item->price)
                                        <span class="text-orange-600 font-semibold">
                                            R{{ number_format($item->total, 2) }}
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="flex items-center space-x-2 mt-1 text-sm text-orange-700">
                                    @if($item->category)
                                        <span class="bg-orange-200 text-orange-800 px-2 py-1 rounded-full">
                                            {{ $item->category }}
                                        </span>
                                    @endif
                                    @if($item->store)
                                        <span class="bg-amber-200 text-amber-800 px-2 py-1 rounded-full">
                                            {{ $item->store }}
                                        </span>
                                    @endif
                                    @if($item->price)
                                        <span class="text-orange-600">
                                            (R{{ number_format($item->price, 2) }} each)
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            <button wire:click="startEdit({{ $item->id }})"
                                    class="text-orange-500 hover:text-orange-700 transition duration-150"
                                    title="Edit">
                                ✏️
                            </button>
                            <button wire:click="deleteItem({{ $item->id }})"
                                    class="text-red-500 hover:text-red-700 transition duration-150"
                                    title="Delete">
                                🗑️
                            </button>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        
        @if($items->isEmpty())
            <div class="p-8 text-center text-orange-600">
                <p class="text-lg">Your grocery list is empty.</p>
                <p class="text-sm">Add some items using the form above!</p>
            </div>
        @endif
    </div>
</div>
