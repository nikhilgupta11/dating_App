<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    function index()
    {
        $data = Setting::first();

        if ($data != null) {
            return view('admin/pages/setting_index', compact('data'));
        } else {
            return view('admin/pages/setting_form', compact('data'));
        }
    }

    function edit($id)
    {
        $data = Setting::where('id', '=', $id)->first();
        return view('admin/pages/setting_form', compact('data'));
    }

    function store(Request $request, $id = null)
    {
        if ($id != null) {
            $validator = Validator::make($request->all(), [
                // 'logo' => 'mimes: png | max: 2048',
                // 'banner' => 'mimes: png,jpg,jpeg',
                'deafult_currency' => 'required | max:15',
                'deafult_country_code' => 'required | max:4',
                'language' => 'required | max:25',
                'smtp_mail' => 'required | email | max:200',
                'smtp_username' => 'required | max:30',
                'smtp_password' => 'required | min:8 | max:30',
                'smtp_host' => 'required | max:50',
                'smtp_port' => 'required | max:6 | min:4',
                'smtp_encryption' => 'required | max:8',
                'company_name' => 'required | max:20'
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->errors());
            };
            $media = Setting::where('id', '=', $id)->first();
            if ($request->has('logo')) {
                $logo = $request->logo->getClientOriginalName();
                $request->logo->move(public_path('assets/'), $logo);
            } else {
                $logo = $media->logo;
            }

            if ($request->has('banner')) {
                $banner = $request->banner->getClientOriginalName();
                $request->banner->move(public_path('assets/'), $banner);
            } else {
                $banner = $media->banner;
            }
            Setting::where('id', '=', $id)->update([
                'logo' => $logo,
                'banner' => $banner,
                'deafult_currency' => $request->deafult_currency,
                'deafult_country_code' => $request->deafult_country_code,
                'language' => $request->language,
                'smtp_mail' => $request->smtp_mail,
                'smtp_username' => $request->smtp_username,
                'smtp_password' => $request->smtp_password,
                'smtp_host' => $request->smtp_host,
                'smtp_port' => $request->smtp_port,
                'smtp_encryption' => $request->smtp_encryption,
                'company_name' => $request->company_name
            ]);
            return back()->with('success', 'Settings updated succesfully!!');
        } else {
            $validator = Validator::make($request->all(), [
                // 'logo' => 'required | mimes: png | max: 2048',
                // 'banner' => 'required | mimes: png,jpg,jpeg',
                'deafult_currency' => 'required | max:15',
                'deafult_country_code' => 'required | max:4',
                'language' => 'required | max:25',
                'smtp_mail' => 'required | email | max:200',
                'smtp_username' => 'required | max:30',
                'smtp_password' => 'required | min:8 | max:30',
                'smtp_host' => 'required | max:50',
                'smtp_port' => 'required | max:6 | min:4',
                'smtp_encryption' => 'required | max:8',
                'company_name' => 'required | max:20'
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->errors());
            };

            // if ($request->has('logo')) {
            //     $logo = $request->logo->getClientOriginalName();
            //     $request->logo->move(public_path('assets/'), $logo);
            // }

            // if ($request->has('banner')) {
            //     $banner = $request->banner->getClientOriginalName();
            //     $request->banner->move(public_path('assets/'), $banner);
            // }

            Setting::create([
                // 'logo' => $logo,
                // 'banner' => $banner,
                'deafult_currency' => $request->deafult_currency,
                'deafult_country_code' => $request->deafult_country_code,
                'language' => $request->language,
                'smtp_mail' => $request->smtp_mail,
                'smtp_username' => $request->smtp_username,
                'smtp_password' => $request->smtp_password,
                'smtp_host' => $request->smtp_host,
                'smtp_port' => $request->smtp_port,
                'smtp_encryption' => $request->smtp_encryption,
                'company_name' => $request->company_name
            ]);

            return back()->with('success', 'Setting Created Succesfully!!');
        }
    }

    // cms
    function cms_index_function()
    {
        $data = CMS::all();
        return view('admin/pages/cms_index', compact('data'));
    }

    function show_cms_function($id)
    {
        $data = CMS::where('id', '=', $id)->first();

        return view('admin/pages/cms_detail', compact('data'));
    }

    function delete_cms_function($id)
    {
        $cms_name = CMS::where('id', '=', $id)->first();
        CMS::where('id', '=', $id)->delete();

        return back()->with('error', $cms_name->name . ' Deleted Succesfully');
    }

    function cms_store_function(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'image' => 'mimes: png | max: 2048',
            'name' => 'required | max:30',
            'slug' => 'required | max:40',
            'title' => 'required | max:100',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        };

        // if ($request->has('image')) {
        //     $image = $request->image->getClientOriginalName();
        //     $request->image->move(public_path('assets/'), $image);
        // }

        if ($request->status == 'on') {
            $status = 1;
        } else {
            $status = 0;
        }

        CMS::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $status,
            // 'image' => $image,
        ]);

        return redirect()->route('cms_index')->with('success', "Content page created succesfully!!");
    }
}
