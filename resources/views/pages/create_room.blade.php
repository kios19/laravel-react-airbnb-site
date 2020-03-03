@extends('layouts.app')

@section('content')
<script src="https://cdn.tiny.cloud/1/qrb1a5mz75qb45yk7656r5939by3r1kq6clvuqc5h0bv9uwi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


<script>
    tinymce.init({
      selector: '#description'
    });
  </script>
<div class="site-section">
    <div class="container">
        <div class="row">
        <div class ="col-md-6">
        <form enctype='multipart/form-data' action="{{ route('admin.store')}}"
            method="POST" class="form">
            {{ method_field('POST') }}
            {{ csrf_field() }}

            <div class="form-group row">

                <div class="col-md-12">
                    <label for="type" class="text-black">{{ __('Type') }}</label>
                    <select style="width: 400px" id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{  old('type')   }}" autocomplete="type" autofocus>
                        <option hidden disabled selected value>(select an option)</option>
                        @foreach( $types as $type )
                        <option value="{{ $type->type_id }}" {{ old('type') == $type->type_name ? 'selected' : '' }}>{{ $type->type_name }}</option>
                    @endforeach
                    </select>
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="col-md-12">
                    <label for="title" class="text-black">{{ __('Title') }}</label>
                    <input style="width: 400px" id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{  old('title')   }}" required autocomplete="title" autofocus>

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>



                <div class="col-md-12">
                    <label for="guests" class="text-black">{{ __('Guests') }}</label>
                    <input style="width: 400px" id="guests" type="number" class="form-control @error('guests') is-invalid @enderror" name="guests" value="{{  old('guests')   }}" required autocomplete="guests" autofocus>

                    @error('guests')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="children" class="text-black">{{ __('Children') }}</label>
                    <input style="width: 400px" id="children" type="number" class="form-control @error('children') is-invalid @enderror" name="children" value="{{  old('children')   }}" required autocomplete="children" autofocus>

                    @error('children')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="adults" class="text-black">{{ __('Adults') }}</label>
                    <input style="width: 400px" id="adults" type="number" class="form-control @error('adults') is-invalid @enderror" name="adults" value="{{  old('adults')   }}" required autocomplete="adults" autofocus>

                    @error('adults')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="beds" class="text-black">{{ __('Beds') }}</label>
                    <input style="width: 400px" id="beds" type="number" class="form-control @error('beds') is-invalid @enderror" name="beds" value="{{  old('beds')   }}" required autocomplete="beds" autofocus>

                    @error('beds')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="rooms" class="text-black">{{ __('Rooms') }}</label>
                    <input style="width: 400px" id="rooms" type="number" class="form-control @error('rooms') is-invalid @enderror" name="rooms" value="{{  old('rooms')   }}" required autocomplete="rooms" autofocus>

                    @error('rooms')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="price" class="text-black">{{ __('Price') }}</label>
                    <input style="width: 400px" id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{  old('price')   }}" required autocomplete="price" autofocus>

                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

            </div>

        </div>
        <div class="col-md-6">


            <div class="col-md-12">
                <label for="location" class="text-black">{{ __('Location') }}</label>
                <select style="width: 400px" id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{  old('location')   }}"  autocomplete="location" autofocus>
                    <option hidden disabled selected value>(select an option)</option>
                    @foreach( $locations as $location )
                    <option value="{{ $location->lid }}" {{ old('location') == $location->location_name ? 'selected' : '' }}>{{ $location->location_name }}</option>
                @endforeach
                </select>
                @error('location')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="description" class="text-black">{{ __('Description') }}</label>
                <textarea rows="5" style="height: 600px, width: 200px" id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{  old('description')   }}" required autocomplete="description" autofocus>
                </textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="condition" class="text-black">{{ __('Condition') }}</label>
                <input style="width: 400px" id="condition" type="text" class="form-control @error('condition') is-invalid @enderror" name="condition" value="{{  old('condition')   }}" required autocomplete="condition" autofocus>

                @error('condition')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="image1" class="text-black">{{ __('Image 1') }}</label>
                <input style="width: 400px" class="form-control-file" id="image1" type="file" class="form-control @error('image1') is-invalid @enderror" name="image1" value="{{  old('image1')   }}" required autocomplete="image1" autofocus>

                @error('image1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="image2" class="text-black">{{ __('Image 2') }}</label>
                <input style="width: 400px" class="form-control-file" id="image2" type="file" class="form-control @error('image2') is-invalid @enderror" name="image2" value="{{  old('image2')   }}"  autocomplete="image2" autofocus>

                @error('image2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="image3" class="text-black">{{ __('Image 3') }}</label>
                <input style="width: 400px" class="form-control-file" id="image3" type="file" class="form-control @error('image3') is-invalid @enderror" name="image3" value="{{  old('image3')   }}"  autocomplete="image3" autofocus>

                @error('image3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-12" style="padding-top: 50px">
                <input type="submit" value="Save Room" class="btn btn-primary py-2 px-4 text-white">
            </div>
        </form>
        </div>
        </div>
    </div>
</div>
@endsection
