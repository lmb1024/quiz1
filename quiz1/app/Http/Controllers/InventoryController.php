<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryModel;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all the items from the inventory.

        $inventoryItems = InventoryModel::all();



        // Show the inventory list page and send all the items to it.

        return view('inventory.index', compact('inventoryItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         // Show the page where users can add a new item.

         return view('inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if the user entered everything correctly.

 // here is the documentation for laravel's validation rules: https://laravel.com/docs/12.x/validation#rule-accepted

    $validated = $request->validate([

        'name' => 'required|string|min:3',  // Name must have at least 3 letters.

        'quantity' => 'required|integer|min:0',  // Quantity must be a number and not negative.

        'price' => 'required|numeric|min:0',  // Price must be a number and not negative.

    ]);



    // Save the new item to the inventory.

    InventoryModel::create($validated);



    // Go back to the list of items and show a success message.

    return redirect(env('APP_URL') . '/inventory')

       ->with('success', 'Item added successfully.');

    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the item by its ID.

        $inventoryItem = InventoryModel::find($id);



        // If the item is not found, go back to the list with an error message.

        if (!$inventoryItem) {

            return redirect(env('APP_URL') . '/inventory')

           ->with('error', 'Item not found.');

        }



        // Show the page to edit the item.

        return view('inventory.edit', compact('inventoryItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Check if the user entered everything correctly.

        $validated = $request->validate([

            'name' => 'required|string|min:3',  // Name must have at least 3 letters.

            'quantity' => 'required|integer|min:0',  // Quantity must be a number and not negative.

            'price' => 'required|numeric|min:0',  // Price must be a number and not negative.

        ]);



        // Find the item by its ID.

        $inventoryItem = InventoryModel::find($id);



        // If the item is not found, go back to the list with an error message.

        if (!$inventoryItem) {

            return redirect(env('APP_URL') . '/inventory')

           ->with('error', 'Item not found.');

        }



        // Update the item with the new details.

        $inventoryItem->update($validated);



        // Go back to the list of items and show a success message.

        return redirect(env('APP_URL') . '/inventory')

           ->with('success', 'Item updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the item by its ID.

        $inventoryItem = InventoryModel::find($id);



        // If the item is not found, go back to the list with an error message.

        if (!$inventoryItem) {

            return redirect(env('APP_URL' . '/inventory'))

               ->with('error', 'Item not found');

        }



        // Remove the item from the inventory.

        $inventoryItem->delete();



        // Go back to the list of items and show a success message.

        return redirect(env('APP_URL') . '/inventory')

           ->with('success', 'Item deleted successfully.');
    }
}
