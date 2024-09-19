<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // get all items for inventory
    public static function index()
    {
        $items = Item::all();
        return response()->json(['data' => $items, 'success' => true]);
    }

    // save item to inventory
    public function store(Request $request)
    {
        // validation input for user
        $validateData = $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // if data is validated, create new item to store in inventory

        $item = Item::create($validateData);

        return response()->json(['data' => $item, 'success' => true]);
    }


    /**
     * Display the specified resource.
     */

     // get item with item id
    public function show(string $id)
    {
        $item = Item::find($id);

        if (!$item){
            return response()->json(['message' => 'Data item not found', 'success' => false], 404);  // return 404 not found if item not found  // if not found, return a 404 status code and a message stating the item was not found.  // 200 is returned if the item is found.  // 200 means "OK" or "Success" in HTTP lingo.  // The response body contains the item data.  // If the item is not found, the response body will be empty.  // The response status code will be 404 if the item is not found.  // If the item is found, the response status code will be 200.  // The response body will contain the item data.  // If the item is not found, the response body will be empty.  // The response status code will be 404 if
        }
        return response()->json(['data' => $item, 'success' => true], 200);
    }

    // update item with item id
    public function update(Request $request, string $id)
    {
        $item = Item::find($id); // search the item
         

        if (!$item){
            return response()->json(['message' => 'Item not found'], 404);
        }

        // validation input for user
        $validateData = $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // update data item 
        $item->update($validateData);

        return response()->json(['data' => $item, 'success' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     */

     // delete item with item id
    public function destroy(string $id)
    {
        $item = Item::find($id);

        if (!$item){
            return response()->json(['message' => 'Item not found'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'Data item has been deleted', 'success' => true]);
    }
}
