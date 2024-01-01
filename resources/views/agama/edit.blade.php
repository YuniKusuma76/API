<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>iFamily Card - Edited Agama</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="/css/style-header.css">
</head>

<body>
  {{-- Start Title Sidebar --}}
  <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
      <div class="sidebar-brand">
        <h2>
          <span class="las la-smile"></span>
          <span>iFamilyCard</span>
        </h2>
      </div>
  {{-- End Title Sidebar --}}

  {{-- Start Sidebar --}}
    <div class="sidebar-menu">
        <ul>
            <li>
                <a href="/dashboard"><span class="las la-home"></span>
                <span>Home</span></a>
            </li>
            <li>
                <a href="/agama" class="active"><span class="las la-book"></span>
                <span>Agama</span></a>
            </li>
            <li>
                <a href="/penduduk"><span class="las la-users"></span>
                <span>Penduduk</span></a>
            </li>
            <li>
                <a href="/kk"><span class="las la-film"></span>
                <span>Kartu Keluarga</span></a>
            </li>
            <li>
                <a href="/anggotakk"><span class="las la-users"></span>
                <span>Anggota Keluarga</span></a>
            </li>
            <li>
                <a href="/hubungankk"><span class="las la-heart"></span>
                <span>Hubungan Keluarga</span></a>
            </li>
            <li>
                <a href="/logout"><span class="las la-sign-out-alt"></span>
                <span>Logout</span></a>
            </li>
        </ul>
    </div>
  </div>
  {{-- End Sidebar --}}

  {{-- Start Form --}}
    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label> Dashboard
            </h2>
        </header>
    
        <main>
          <div class="card">
            <div class="card-header text-center">
              <h1>Form Agama</h1>
            </div>
            <div class="card-body">
              <form name="formAgama" action="/agama/{{ $agama->id }}" method="post" onsubmit="return validateForm()">
                @csrf
                @method('PUT')
                  <div class="form-group">
                    <label>Nama Agama</label>
                    <input type="text" name="agama" id="agama" placeholder="Agama" class="form-control" value="{{ $agama->agama }}">
                  </div>
                  <div>
                    <button type="submit" name="submit" class="btn btn-primary mb-4">Save</button>
                  </div>
              </form>
            </div>
          </div>
          <script>
            function validateForm() {
              // Validasi Agama
              if (document.forms["formAgama"]["agama"].value == "") {
                  alert("Anda belum memasukkan Agama Anda");
                  document.forms["formAgama"]["agama"].focus();
                  return false;
              }
            }
        </script>
        </main>
    </div>
    {{-- End List --}}
    
</body>
</html>