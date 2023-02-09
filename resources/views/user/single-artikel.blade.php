<x-user-layout>
    <br>
    <div class="container">
        @if($message = Session::get("success"))
            <div class="alert alert-success">
                <h3>{{$message}}</h3>
            </div>
        @endif
        <div class="row flex-row">
            <h1>{{$product[0]->name}}</h1>
            <div class="d-flex flex-column justify-content-sm-start justify-content-center gap-2 col-sm-6 col-10">
                <div id="singleProductImage" class="singleProductImage col-4" style="background-image: url('{{asset("images/products") . "/" . $product[0]->image}}')">
                </div>
                <div class="col p-2 d-flex gap-2 flex-wrap">
                    <div class="singleProductImageSmall" id="{{$product[0]->image}}" onclick="replaceImage(this)" style="background-image: url('{{asset("images/products") . "/" . $product[0]->image}}')"></div>
                    @foreach($productImages as $productImage)
                        <div class="singleProductImageSmall" id="{{$productImage->image}}" onclick="replaceImage(this)" style="background-image: url('{{asset("images/products/") . "/" . $productImage->image}}')"></div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6 col-10 d-flex flex-column gap-2">
                <h3 class="text-primary">&euro;{{$product[0]->price}}</h3>
                <p>{{$product[0]->description}}</p>
                <form method="post">
                    @csrf
                    @method("POST")
                    <div class="form-group">
                        <label for="">Hoeveelheid</label>
                        <input type="number" class="form-control" value="1" name="amount">
                    </div>
                    <button type="submit" href="" class="btn btn-primary mb-2 w-100">
                        In winkelwagen <i class="fa-solid fa-cart-shopping"></i>
                    </button>
                </form>
            </div>
            <div class="col-10 mt-4">
                <div class="d-flex justify-content-between flex-md-row flex-column mb-md-0 mb-2">
                    <h2>Reviews van klanten</h2>
                    @if(Session::get("user"))
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Schrijf een review</button>
                    @else
                        <a class="btn btn-primary" href="{{route("loginView")}}">Login om een review te schrijven</a>
                    @endif
                </div>
                <div class="d-flex flex-column">
                    <div class="d-flex gap-2 mb-2">
                        @if(count($reviews) > 0)
                            <h3>Gemiddelde score van {{count($reviews)}} reviews: {{$averageScore}}</h3>
                        @endif
                    </div>
                    <hr>
                    @if(count($reviews) > 0)
                        @foreach($reviews as $review)
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <h4>{{$review->name . " " . $review->prefix . " " . $review->lastname}}: </h4>
                                    <div class="d-flex">
                                        @if($review->score == 1)
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-solid fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-regular fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-regular fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-regular fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-regular fa-star"></i></p>
                                        @elseif($review->score == 2)
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-solid fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-solid fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-regular fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-regular fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-regular fa-star"></i></p>
                                        @elseif($review->score == 3)
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-solid fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-solid fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-solid fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-regular fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-regular fa-star"></i></p>
                                        @elseif($review->score == 4)
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-solid fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-solid fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-solid fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-solid fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-regular fa-star"></i></p>
                                        @elseif($review->score == 5)
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-solid fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-solid fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-solid fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-solid fa-star"></i></p>
                                            <p class="d-flex align-items-center fs-3 text-warning"><i class="fa-solid fa-star"></i></p>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <small>{{$review->created_at}}</small>
                                    <p>{{$review->review}}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @else
                        <h3 class="text-danger">Er zijn nog geen reviews geplaatst. Wees de eerste!</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Review achterlaten voor {{$product[0]->name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route("singleItemReview", $product[0]->id)}}" class="d-flex gap-2 flex-column">
                        @csrf
                        @method("POST")
                        <div class="form-group d-flex align-items-center">
                            <label for="">Score (1-5):</label>
                            <fieldset class="rating">
                                <input type="radio" id="star5" name="score" value="5" />
                                <label for="star5">5 stars</label>
                                <input type="radio" id="star4" name="score" value="4" />
                                <label for="star4">4 stars</label>
                                <input type="radio" id="star3" name="score" value="3" />
                                <label for="star3">3 stars</label>
                                <input type="radio" id="star2" name="score" value="2" />
                                <label for="star2">2 stars</label>
                                <input type="radio" id="star1" name="score" value="1" />
                                <label for="star1">1 star</label>
                            </fieldset>
                        </div>
                        <div class="form-group">
                            <textarea name="review" class="form-control" placeholder="Schrijf hier uw review." cols="30" rows="10"></textarea>
                        </div>
                        <input type="text" hidden name="productId" value="{{$product[0]->id}}">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Verzenden">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuleren</button>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
