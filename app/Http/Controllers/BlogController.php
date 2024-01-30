<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    public function create(){
        return view('blog.postBlog');
    }

    public function postBlog(Request $request){
        $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'image'=>'image|mimes:png,jpg|max:6000'
        ]);

        $imagePath = null;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('blog_images', $imageName, 'public');
        }

        $blog= new blog([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'userId'=>auth()->id(),
            'image'=>$imagePath
        ]);

        $blog->save();
        return redirect()->route('blogs.store')->with('success','Blog Posted successfully');
    }

    public function getAllBlogs(Request $request){
        $blogs = blog::orderBy('created_at', 'desc')->paginate(1);

        return view('blog.viewBlog',compact('blogs'));
    }

    public function viewMyBlog(Request $request){
        $blogs = blog::where('userId',auth()->id())->get();
        return view('blog.viewBlog',['blogs'=>$blogs]);
    }

    public function viewBlog(Request $request,$Blogid){
        logger("i'm hit");
        $blog = blog::find($Blogid);
        if(!$blog){
            abort(404,'Blog not found on View Blog');
        }
        if($blog->userId==auth()->id()){
            return view('blog.editBlog',['blog'=>$blog]);
        }
        return view('blog.viewOneBlog',['blog'=>$blog]);
    }

    public function editBlog(Request $request,$blogId){
        
        $blog = blog::find($blogId);
        if($blog->userId!=auth()->id()){
            abort(403,'Unauthorized');
        }
        $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'image'=>'image|mimes:png,jpg|max:6000'
        ]);

        $imagePath = $blog->image;
        if($request->hasFile('image')){
            logger('Attempting to delete file: ' . $imagePath);
            if (Storage::disk('public')->exists($imagePath)) {
                try {
                    Storage::disk('public')->delete($imagePath);
                    logger('File deleted successfully');
                } catch (\Exception $e) {
                    logger('Error deleting file: ' . $e->getMessage());
                }
            } else {
                logger('File not found at path: ' . $imagePath);
            }
            $image = $request->file('image');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('blog_images', $imageName, 'public');
        }

        $blog->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image'=>$imagePath
        ]);
        return redirect()->route('blogs.viewOne',['id'=>$blog->id])->with('success','Edited Blog successfully');
    }

    public function deleteBlog($blogId){
        $blog = blog::find($blogId);
        if($blog->userId!=auth()->id()){
            abort(403,'Unauthorized');
        }
        if($blog->image){
            $imagePath = $blog->image;
            if (Storage::disk('public')->exists($imagePath)) {
                try {
                    Storage::disk('public')->delete($imagePath);
                } catch (\Exception $e) {
                    logger('Error deleting file: ' . $e->getMessage());
                }
            }
        }
        $blog->delete();
        return redirect()->route('blogs.viewMy')->with('success','Blog deleted successfully');
    }

    public function searchBlog(Request $request){

        $query = $request->input('queryy','');
        $blogs = blog::where('title','like',"%$query%")
                    ->orderBy('created_at','desc')
                    ->paginate(1);
        logger($blogs);
        return view('blog.viewBlog',compact('blogs'));
    }
}
