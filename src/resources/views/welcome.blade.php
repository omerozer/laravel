<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Kayıt Formu</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, -apple-system, sans-serif; padding: 2rem; max-width: 600px; margin: 0 auto; background: #f5f5f5; }
        h1 { margin-bottom: 1.5rem; color: #333; }
        .form-box { background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 2rem; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.35rem; font-weight: 500; color: #555; }
        input { width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #ddd; border-radius: 6px; font-size: 1rem; }
        input:focus { outline: none; border-color: #6366f1; }
        input[type="file"] { padding: 0.4rem; }
        img.thumb { width: 48px; height: 48px; object-fit: cover; border-radius: 6px; }
        button { padding: 0.6rem 1.5rem; background: #6366f1; color: white; border: none; border-radius: 6px; font-size: 1rem; cursor: pointer; font-weight: 500; }
        button:hover { background: #4f46e5; }
        .success { background: #dcfce7; color: #166534; padding: 0.75rem; border-radius: 6px; margin-bottom: 1rem; }
        .list-box { background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .list-box h2 { margin-bottom: 1rem; color: #333; font-size: 1.25rem; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8fafc; font-weight: 600; color: #475569; }
        .empty { color: #94a3b8; text-align: center; padding: 2rem; }
    </style>
</head>
<body>
    <h1>Kayıt Formu</h1>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <div class="form-box">
        <form action="{{ route('kisi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="ad">Ad</label>
                <input type="text" id="ad" name="ad" value="{{ old('ad') }}" required>
                @error('ad')<small style="color:#dc2626;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label for="soyad">Soyad</label>
                <input type="text" id="soyad" name="soyad" value="{{ old('soyad') }}" required>
                @error('soyad')<small style="color:#dc2626;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label for="yas">Yaş</label>
                <input type="number" id="yas" name="yas" value="{{ old('yas') }}" min="1" max="150" required>
                @error('yas')<small style="color:#dc2626;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label for="email">E-posta</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ornek@mail.com">
                @error('email')<small style="color:#dc2626;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label for="gorsel">Görsel</label>
                <input type="file" id="gorsel" name="gorsel" accept="image/jpeg,image/png,image/gif,image/jpg">
                @error('gorsel')<small style="color:#dc2626;">{{ $message }}</small>@enderror
            </div>
            <button type="submit">Kaydet</button>
        </form>
    </div>

    <div class="list-box">
        <h2>Kayıtlı Kişiler</h2>
        @if($kisiler->isEmpty())
            <p class="empty">Henüz kayıt yok. Yukarıdaki formdan ekleyebilirsiniz.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Görsel</th>
                        <th>Ad</th>
                        <th>Soyad</th>
                        <th>Yaş</th>
                        <th>E-posta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kisiler as $kisi)
                        <tr>
                            <td>
                                @if($kisi->gorsel)
                                    <img src="{{ Storage::url($kisi->gorsel) }}" alt="" class="thumb">
                                @else
                                    <span style="color:#94a3b8;">-</span>
                                @endif
                            </td>
                            <td>{{ $kisi->ad }}</td>
                            <td>{{ $kisi->soyad }}</td>
                            <td>{{ $kisi->yas }}</td>
                            <td>{{ $kisi->email ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
