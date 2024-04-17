<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDemo; // Import the UserDemo model

class UserDemoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'number' => 'required|string',
        ]);

        // Create a new userdemo instance
        $userdemo = new UserDemo;
        $userdemo->name = $validatedData['name'];
        $userdemo->number = $validatedData['number'];
        $userdemo->save();

        // Return a JSON response with success message and inserted data
        return response()->json([
            'message' => 'User details inserted successfully',
            'data' => $userdemo
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the userdemo record by id
        $userdemo = UserDemo::find($id);

        // If the userdemo record doesn't exist, return a 404 Not Found response
        if (!$userdemo) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Return a JSON response with the userdemo record
        return response()->json(['data' => $userdemo], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the userdemo record by id
        $userdemo = UserDemo::find($id);

        // If the userdemo record doesn't exist, return a 404 Not Found response
        if (!$userdemo) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Delete the userdemo record
        $userdemo->delete();

        // Return a JSON response with success message
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
