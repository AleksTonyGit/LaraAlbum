<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use App\Album;
use App\Image;

class ImagesController extends Controller
{
    /*форма создания нового изображения*/
    public function getForm($id)
    {
        $album = Album::find($id);
        return view('addimage')
            ->with('album',$album);
    }

    /*обработка формы создания нового изображения и добавления его в БД*/
    public function postAdd(Request $request)
    {
        $rules = [
            'album_id' => 'required|numeric|exists:albums,id',
            'image'=>'required|image'
        ];
        $input = ['album_id' => null];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->route('add_image', ['id' => $request->get('album_id')])->withErrors($validator)->withInput();
        }
        $file = $request->file('image');
        $random_name = str_random(8);
        $destinationPath = 'albums/';
        $extension = $file->getClientOriginalExtension();
        $filename=$random_name.'_album_image.'.$extension;
        $uploadSuccess = $request->file('image')->move($destinationPath, $filename);
        Image::create(array(
            'description' => $request->get('description'),
            'image' => $filename,
            'album_id'=> $request->get('album_id')
        ));
        return redirect()->route('show_album',['id'=>$request->get('album_id')]);
    }

    /*удаление изображения*/
    public function getDelete($id)
    {
        $image = Image::find($id);
        $image->delete();
        return redirect()->route('show_album',['id'=>$image->album_id]);
    }

    /*перемещение изображения в другой альбом*/
    public function postMove(Request $request)
    {
        $rules = array(
            'new_album' => 'required|numeric|exists:albums,id',
            'photo'=>'required|numeric|exists:images,id'
        );
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->route('index');
        }
        $image = Image::find($request->get('photo'));
        $image->album_id = $request->get('new_album');
        $image->save();
        return redirect()->route('show_album', ['id'=>$request->get('new_album')]);
    }
}
