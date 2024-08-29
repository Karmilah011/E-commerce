@extends('template-admin.master')

@section('title', 'Halaman Create Products')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Create Data Products</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <form method="POST" action="{{route('products.store')}}" enctype='multipart/form-data'>
                                @csrf
                                <div class="mb-3">
                                    <div class="row mb-2">
                                        <label class="form-label" for="name">Name Product</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            aria-describedby="emailHelp" placeholder="Name Product" autocomplete="off">
                                        <small id="name" class="form-text text-muted">*Product is required</small>
                                    </div> 
                                    <div class="row mb-2">
                                        <label class="form-label" for="price">Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" name="price" class="form-control" id="priceInput" aria-describedby="priceHelp" placeholder="Price" autocomplete="off">
                                        </div>
                                        <small id="priceHelp" class="form-text text-muted">*Price is required</small>
                                    </div>                                    
                                    <div class="row mb-2">
                                        <label class="form-label" for="stock">Stock</label>
                                        <input type="text" name="stock" class="form-control" id="stock"
                                            aria-describedby="emailHelp" placeholder="Stock" autocomplete="off"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                        <small id="stock" class="form-text text-muted">*Stock is required</small>
                                    </div>                                    
                                    <div class="row mb-2">
                                        <label class="form-label" for="description">Description</label>
                                        <textarea name="description" class="form-control" id="description"
                                            aria-describedby="emailHelp" placeholder="Description" autocomplete="off"></textarea>                                        <small id="desc" class="form-text text-muted">*Description is required</small>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="form-label" for="size">Size</label>
                                        <input type="text" name="size" class="form-control" id="size"
                                            aria-describedby="emailHelp" placeholder="size" autocomplete="off">
                                        <small id="size" class="form-text text-muted">*Size is required (Because Multiple :"S,M,L,XL", Because All Size : "All Size")</small>
                                    </div>

                                    <div class="row mb-2">
                                        <label class="form-label" for="tags">Tags</label>
                                        <input type="text" name="tags" class="form-control" id="tags"
                                            aria-describedby="emailHelp" placeholder="tags" autocomplete="off">
                                        <small id="tags" class="form-text text-muted">*Tags is required</small>
                                    </div>

                                    <div class="row mb-2">
                                        <label class="form-label" for="brand_id">Brand</label>
                                            <select name="brand_id" id="brand_id" class="form-select">
                                                @foreach ($brands as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        <small id="brand_id" class="form-text text-muted">*Brand is required</small>
                                    </div>

                                    <div class="row mb-2">
                                        <label class="form-label" for="category_id">Category</label>
                                            <select name="category_id" id="category_id" class="form-select" autocomplete="off">
                                                @foreach ($categories as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        <small id="category_id" class="form-text text-muted">*Category is required</small>
                                    </div>


                                    <div class="row">
                                        <label class="form-label" for="image">image</label>
                                        <input name="image" class="form-control" id="image"
                                            aria-describedby="emailHelp"type="file" >
                                        <small id="image" class="form-text text-muted">(optional)</small>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12"></div>
            </div>
        </div>
    </div>
    <script>
        // Fungsi untuk memformat angka menjadi format mata uang
        function formatNumber(num) {
            var parts = num.toString().split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            return parts.join(',');
        }
    
        // Ambil elemen input harga
        var priceInput = document.getElementById('priceInput');
    
        // Tambahkan event listener untuk memformat angka saat input berubah
        priceInput.addEventListener('input', function(event) {
            // Ambil nilai input
            var value = event.target.value;
    
            // Hilangkan semua karakter selain angka dan koma
            var cleanValue = value.replace(/[^\d,]/g, '');
    
            // Konversi nilai menjadi format angka dengan menggunakan fungsi formatNumber
            var formattedValue = formatNumber(cleanValue);
    
            // Set nilai input dengan format angka yang baru
            event.target.value = formattedValue;
        });
    </script>
@endsection