<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\HousePhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;


class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $houses = House::all();
       $photos = House::with('photos')->get();
       return view('index', compact('houses', 'photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    
    public function create()
    {
        $viewData = [
            'house' => new House(), 
            'photos' => []
        ];
        return view('create', $viewData);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $id = $request->post('id');
        $title = $request->post('title');
        $description = $request->post('description');
        $surface_area = $request->post('surface_area');
        $day_price = $request->post('day_price');

    
        if(empty($id))
        {
            $house = new House();
            
            
        }
        else
        {

            $house = House::findOrFail($id);
        }
        
        $house->title = $title;
        $house->description = $description;
        $house->surface_area = $surface_area;
        $house->day_price = $day_price;
        $house->user_id = 1; // moet nog opgelost worden
        
        $house->save();

     
        $file = $request->file('afbeelding');
        if($file)
        {
            $housePhoto = new HousePhoto();
            $housePhoto->house_id = $house->id;
            $housePhoto->sorting = 0;
            $housePhoto->file_name =  $file->getClientOriginalName();
            $housePhoto->save();
            
            $addDir = public_path() . '/images/' . $house->id;
            if(!is_dir($addDir))
            {
                mkdir($addDir);
            }
            
            $file->move($addDir, $housePhoto->id.'-'. $file->getClientOriginalName());
        }
        // $housePhoto->file_name = 
    //     echo '<pre>' . print_r($request->file('afbeelding'), true) . '</pre>';

/*
    
    
        exit();
        $house = House::findOrFail($house->id);
*/
        
        $dataVoorView = [
            'house' => $house,
            'photos' => HousePhoto::where('house_id', $house->id)->get()

        ];
  
        return view('create', $dataVoorView);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $house = House::findOrFail($id);

        $photos = $house->photos;
       // echo '<pre>' . print_r($house_photos, true) . '</pre>';
       

        $data = [
            'house' => $house,
            'photos' => $photos
        ];
        return view('show', $data);
    }

    public function photos(){
        return $this->hasMany(HousePhoto::class);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $house = House::findOrFail($id);

        $photos = $house->photos;
       // echo '<pre>' . print_r($house_photos, true) . '</pre>';
       

        $data = [
            'house' => $house,
            'photos' => $photos
        ];
        return view('create', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'surface_area' => 'required|numeric|min:1',
            'day_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $house = House::findOrFail($id);

        $house->update([
            'title' => $request->input('title'),
            'surface_area' => $request->input('surface_area'),
            'day_price' => $request->input('day_price'),
            'description' => $request->input('description')
        ]);
        // $id
        // formulier laten zien 
        return view('create', [ 
            'house' => $house,

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $house = House::findOrFail($id);
        $house->delete();

        return redirect()->route('houses.index')->with('success', 'Huis succesvol verwijderd!');
    }

    public function destroyImage(string $house_id, string $photo_id){


        $house_photos = HousePhoto::findOrFail($photo_id);       
        $house_photos->delete();

        return redirect()->route('houses.edit', ['id' => $house_id])->with('success', 'foto succesvol verwijderd!');
    }
}
