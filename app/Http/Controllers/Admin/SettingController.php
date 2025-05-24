<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Ayar düzenleme formunu gösterir.
     */
    public function edit()
    {
        // 'session_timeout' ayarı yoksa 30 değeriyle oluşturulur
        $setting = Setting::firstOrCreate(
            ['key' => 'session_timeout'],
            ['value' => '30']
        );

        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Ayarı günceller.
     */
    public function update(Request $request)
    {
        $request->validate([
            'value' => 'required|integer|min:1|max:1440', // Dakika cinsinden (1–1440 dk = 1 dk – 24 saat)
        ]);

        Setting::updateOrCreate(
            ['key' => 'session_timeout'],
            ['value' => $request->value]
        );

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Oturum süresi başarıyla güncellendi.');
    }
}
