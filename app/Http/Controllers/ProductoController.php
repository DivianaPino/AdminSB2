<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//modelo
use App\Models\Product;

//importamos la clase validator

use Validator;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all(); //trae todos los elementos que se encuentran en la tabla Project y guardalos en la variable "$projects"
        return view ('extends.table', ['products' => $products]); 
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $new_product=new Product();

        $file = $request->file('imagen'); // obtenemos el archivo
        $random_name = time(); // le colocamos a la imagen un nombre random y con el tiempo y fecha actual 
        $destinationPath = 'images/producto/'; // path de destino donde estaran las imagenes subidas 
        $extension = $file->getClientOriginalExtension();
        $filename = $random_name.'-'.$file->getClientOriginalName(); //concatemos el nombre random creado anteriormente con el nombre original de la imagen (para evitar nombres repetidos)
        $uploadSuccess = $request->file('imagen')->move($destinationPath, $filename); //subimos y lo enviamos al path de Destino

         $new_product->nombre= $request->nombre;
         $new_product->cantidad= $request->cantidad;
         $new_product->description= $request->description;
         $new_product->precio= $request->precio;
         $new_product->featured=$filename;

         $new_product->save();

         return redirect()->route('producto.table');  //Redigir la vista despues de guardar
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::find($id);
        return view('extends.edit', ['products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product= Product::find($id);  //buscar el proyecto que se va a editar por su id 
        // LA VALIDACIÓN:
        $rules = [
            'nombre' => 'required|',
            'cantidad' => 'required|',
            'description' => 'required',
            'precio' => 'required',
            //la imagen no, ya que el usuario puede ser que no quiera actualizarla
        ];

        $validator = Validator::make($request->all(), $rules); //verificar si los campos que viene en la request cumplen con las reglas 

        //si una validacion falla se hace lo siguiente: se redireccion a la vista anterior con los errores y con el validator
        if($validator->fails())  
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('imagen'))
        {

             $file = $request->file('imagen'); // obtenemos el archivo
             $random_name = time(); // le colocamos a la imagen un nombre random y con el tiempo y fecha actual 
             $destinationPath = 'images/producto/'; // path de destino donde estaran las imagenes subidas 
             $extension = $file->getClientOriginalExtension();
             $filename = $random_name.'-'.$file->getClientOriginalName(); //concatemos el nombre random creado anteriormente con el nombre original de la imagen (para evitar nombres repetidos)
             $uploadSuccess = $request->file('imagen')->move($destinationPath, $filename); 
             $product->featured= $filename;
        }
        // unlink($destinationPath.$talent->featured);

       $product->nombre = $request->nombre;
       $product->cantidad = $request->cantidad;
       $product->description = $request->description;
       $product->precio = $request->precio;

       //guardamos 
       $product->save();
       return redirect()->route('producto.table');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            //dd("estamos en el delete");
            $product = Product::find($id);
            $product->delete();
            return redirect()->back();
   
    }
}