<div class="max-w-4xl mx-auto p-6">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Grocery Expense Tracker</h1>
        <div class="bg-white rounded-lg shadow-md p-4 inline-block">
            <p class="text-lg font-semibold text-gray-700">
                Total Estimated Cost: 
                <span class="text-blue-600">${{ number_format($this->totalEstimatedCost, 2) }}</span>
            </p>
        </div>
    </div>

    <!-- Add Item Form -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Add New Item</h2>
        <form wire:submit.prevent="addItem" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Item Name *</label>
                <input type="text" wire:model="newItemName" 
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       placeholder="e.g., Apples">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Quantity *</label>
                <input type="number" wire:model="newItemQuantity" min="1"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Price ($)</label>
                <input type="number" wire:model="newItemPrice" min="0" step="0.01"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       placeholder="0.00">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <input type="text" wire:model="newItemCategory" 
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       placeholder="e.g., Produce">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Store</label>
                <input type="text" wire:model="newItemStore" 
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       placeholder="e.g., Walmart">
            </div>
            <div class="md:col-span-2 lg:col-span-5">
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                    Add Item
                </button>
            </div>
        </form>
    </div>

    <!-- Grocery List -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Grocery List ({{ $items->count() }} items)</h2>
        </div>

        <!-- Edit Form -->
        @if($editingItemId)
        <div class="p-4 bg-yellow-50 border-b border-yellow-200">
            <h3 class="text-lg font-semibold mb-3 text-gray-800">Edit Item</h3>
            <form wire:submit.prevent="updateItem" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Item Name *</label>
                    <input type="text" wire:model="editItemName" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantity *</label>
                    <input type="number" wire:model="editItemQuantity" min="1"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price ($)</label>
                    <input type="number" wire:model="editItemPrice" min="0" step="0.01"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <input type="text" wire:model="editItemCategory" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Store</label>
                    <input type="text" wire:model="editItemStore" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div class="md:col-span-2 lg:col-span-5 flex space-x-2">
                    <button type="submit" 
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Update
                    </button>
                    <button type="button" wire:click="cancelEdit"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
        @endif

        <!-- Items List -->
        <ul class="divide-y divide-gray-200">
            @foreach($items as $item)
                <li class="p-4 hover:bg-gray-50 {{ $item->purchased ? 'bg-green-50' : '' }}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4 flex-1">
                            <input type="checkbox" 
                                   wire:click="togglePurchased({{ $item->id }})"
                                   {{ $item->purchased ? 'checked' : '' }}
                                   class="h-5 w-5 text-blue-600 rounded">
                            
                            <div class="flex-1">
                                <div class="flex items-center space-x-3">
                                    <span class="{{ $item->purchased ? 'line-through text-gray-500' : 'text-gray-900 font-medium' }}">
                                        {{ $item->quantity }}x {{ $item->name }}
                                    </span>
                                    @if($item->price)
                                        <span class="text-green-600 font-semibold">
                                            ${{ number_format($item->total, 2) }}
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="flex items-center space-x-2 mt-1 text-sm text-gray-600">
                                    @if($item->category)
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full">
                                            {{ $item->category }}
                                        </span>
                                    @endif
                                    @if($item->store)
                                        <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">
                                            {{ $item->store }}
                                        </span>
                                    @endif
                                    @if($item->price)
                                        <span class="text-gray-500">
                                            (${{ number_format($item->price, 2) }} each)
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            <button wire:click="startEdit({{ $item->id }})"
                                    class="text-blue-500 hover:text-blue-700"
                                    title="Edit">
                                ✏️
                            </button>
                            <button wire:click="deleteItem({{ $item->id }})"
                                    class="text-red-500 hover:text-red-700"
                                    title="Delete">
                                🗑️
                            </button>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        
        @if($items->isEmpty())
            <div class="p-8 text-center text-gray-500">
                <p class="text-lg">Your grocery list is empty.</p>
                <p class="text-sm">Add some items using the form above!</p>
            </div>
        @endif
    </div>
</div>
