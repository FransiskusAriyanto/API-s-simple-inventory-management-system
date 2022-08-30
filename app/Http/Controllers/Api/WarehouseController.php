<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WarehouseResource;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'warehouse_name' => 'required|string|unique:warehouses',
            'warehouse_code' => 'required|string|unique:warehouses',
        ]);
        $warehouse = Warehouse::create($request->all());
        return response()->json([
            'Data' => new WarehouseResource($warehouse),
            'Message' => 'new warehouse has been created',
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::find($id);
        $request->validate([
            'warehouse_name' => 'required',
            'warehouse_code' => 'required',
        ]);
        $warehouse = Warehouse::create($request->all());
        return response()->json([
            'Data' => new WarehouseResource($warehouse),
            'Message' => 'Warehouse with id' .$id. 'has been updated',
        ], 201);
    }
    public function show($id)
    {
        $warehouse = Warehouse::find($id);
        return response()->json([
            'Data' => new WarehouseResource($warehouse),
        ], 200);
    }
    public function shows()
    {
        $warehouse = Warehouse::get();
        return response()->json([
            'Data' => new WarehouseResource($warehouse),
        ], 200);
    }
}
