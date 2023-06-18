<!DOCTYPE html>
<!---Coding By CodingLab | www.codinglabweb.com--->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!--<title>Registration Form in HTML CSS</title>-->
    <!---Custom CSS File--->
    <link rel="stylesheet" href="{{asset('form')}}/style.css" />
  </head>
  <body>
    <section class="container">
      <header>Registration Form</header>
      <form action="/booking" method="post" class="form">
        @csrf
        <input type="hidden" name="id" value="{{ $id }}">
        <div class="input-box">
          <label>Full Name</label>
          <input type="text" name="nama" placeholder="Enter full name" required />
        </div>
        <div class="column">
          <div class="input-box">
            <label>Phone Number</label>
            <input type="number" name="phone" placeholder="Enter phone number" required />
          </div>
          <div class="input-box">
            <label>tanggal</label>
            <input type="date" name="tanggal" placeholder="Enter date" required />
          </div>
        </div>
        <div class="input-box">
          <label for="">Harga</label>
          <div class="column">
            <div class="select-box">
              <select name="harga">
                <option value="50000">50.000 - Biasa</option>
                <option value="100000">100.000 - Full Service</option>
              </select>
            </div>
          </div>
        </div>
        <div class="input-box address">
          <label>alamat</label>
          <input type="text" name="alamat" placeholder="Enter street address" required />
          {{-- <input type="text" placeholder="Enter street address line 2" required /> --}}
          <label>jam booking</label>
          <div class="column">
            <div class="select-box">
              <select name="waktu">
                <option hidden>jam</option>
                <option>12.00</option>
                <option>13.00</option>
                <option>14.00</option>
                <option>16.00</option>
                <option>17.00</option>
              </select>
            </div>
            {{-- <input type="text" placeholder="Enter your city" required />
          </div>
          <div class="column">
            <input type="text" placeholder="Enter your region" required />
            <input type="number" placeholder="Enter postal code" required />
          </div> --}}
        </div>
        <button>Submit</button>
      </form>
    </section>
  </body>
</html>