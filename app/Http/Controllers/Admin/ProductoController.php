<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\ProductoResource;
use App\Http\Requests\ProductoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Traits\UploadImage;
use App\Models\Producto;
use DB;

class ProductoController extends Controller
{
    use UploadImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=0)
    {
        $productos = Producto::where('restaurante_id', (int) $id)->orderBy('id', 'desc')->get();
        return ProductoResource::collection($productos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoRequest $request)
    {
        try {
            DB::beginTransaction();

            $producto = new Producto();
            $producto->nombre         = $request->input('nombre');
            $producto->descripcion    = $request->input('descripcion');
            $producto->precio         = $request->input('precio');
            $producto->restaurante_id = $request->input('restaurante_id');
            $producto->tipo_id        = $request->input('tipo_id');
            if($request->hasFile('imagen') == true){
                $imagen = $this->subirImagen($request->file('imagen'), false, 'productos');
            }

            $producto->imagen = $imagen;
            $producto->save();

            DB::commit();

            return response()->json([
                'mensaje' => 'El Producto se guardo exitosamente',
                'producto' => new ProductoResource($producto)
            ], Response::HTTP_CREATED);

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            response()->json([
                'mensaje' => 'Error al guardar, consulte al Administrador' . $e,
            ], Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id=0)
    {
        $producto = Producto::findOrFail((int)$id);
        return new ProductoResource($producto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductoRequest $request, $id=0)
    {
        try {
            DB::beginTransaction();

            $producto = Producto::findOrFail((int) $id);

            $producto->nombre         = $request->input('nombre');
            $producto->descripcion    = $request->input('descripcion');
            $producto->precio         = $request->input('precio');
            $producto->restaurante_id = $request->input('restaurante_id');
            $producto->tipo_id        = $request->input('tipo_id');

            if($request->hasFile('imagen') == true){
                $imagen = $this->subirImagen($request->file('imagen'), $producto->imagen, 'productos');
            }
            else{
                $imagen = $producto->imagen;
            }

            $producto->imagen = $imagen;

            $producto->save();

            DB::commit();

            return response()->json([
                'mensaje' => 'El Producto se guardo exitosamente',
                'producto' => new ProductoResource($producto)
            ], Response::HTTP_CREATED);

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            response()->json([
                'mensaje' => 'Error al guardar, consulte al Administrador' . $e,
            ], Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=0)
    {
        $producto = Producto::findOrFail((int) $id);
        $producto->delete();

        return response()->json([
            'mensaje' => 'Eliminado con éxito',
        ], Response::HTTP_OK);
    }

    public function productosMasVendido($id=0)
    {
        $productos = DB::table('pedido_producto')
                        ->join('productos','pedido_producto.producto_id','=','productos.id')
                        ->select(DB::raw('SUM(pedido_producto.cantidad) as Cantidad, productos.nombre as Producto, pedido_producto.producto_id'))
                        ->where('productos.restaurante_id', (int) $id)
                        ->groupBy('pedido_producto.producto_id')
                        ->orderBy('cantidad','desc')->limit(5)->get();
        return response()->json($productos,Response::HTTP_OK);
    }
}
