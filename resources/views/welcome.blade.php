@extends('layouts.layout')
@section('title', 'Eagle Bug Tracker')
@section('content')

{{-- Navigation --}}
@include('components.guest-nav')
{{-- Navigation Ends --}}

{{-- main content --}}
<main>
  <div
    class="relative pt-16 pb-32 flex content-center items-center justify-center"
    style="min-height: 75vh;"
  >
    <div
      class="absolute top-0 w-full h-full bg-center bg-cover"
      style='background-image: url("/images/about.jpg");'
    >
      <span
        id="blackOverlay"
        class="w-full h-full absolute opacity-75 bg-black"
      ></span>
    </div>
    <div class="container relative mx-auto">
      <div class="items-center flex flex-wrap">
        <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
          <div class="pr-12">
            <h1 class="text-white font-semibold text-5xl">
              Keep track of your test results 
            </h1>
            <p class="mt-4 text-lg text-gray-300">
              Eagle bug tracker helps you keep track of results from software testing in real time 
            </p>
          </div>
        </div>
      </div>
    </div>
    <div
      class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden"
      style="height: 70px; transform: translateZ(0px);"
    >
      <svg
        class="absolute bottom-0 overflow-hidden"
        xmlns="http://www.w3.org/2000/svg"
        preserveAspectRatio="none"
        version="1.1"
        viewBox="0 0 2560 100"
        x="0"
        y="0"
      >
        <polygon
          class="text-gray-300 fill-current"
          points="2560 0 2560 100 0 100"
        ></polygon>
      </svg>
    </div>
  </div>
  <section class="pb-20 bg-gray-300 -mt-24">
    <div class="container mx-auto px-4">
      <div class="flex flex-wrap">
        <div class="lg:pt-12 pt-6 w-full md:w-4/12 px-4 text-center">
          <div
            class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
          >
            <div class="px-4 py-5 flex-auto">
              <div
                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-red-400"
              >
                <i class="fas fa-award"></i>
              </div>
              <h6 class="text-xl font-semibold">Create</h6>
              <p class="mt-2 mb-4 text-gray-600">
                Sign up, create a project, and start testing for free 
              </p>
            </div>
          </div>
        </div>
        <div class="w-full md:w-4/12 px-4 text-center">
          <div
            class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
          >
            <div class="px-4 py-5 flex-auto">
              <div
                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-blue-400"
              >
                <i class="fas fa-user-friends"></i>
              </div>
              <h6 class="text-xl font-semibold">Collaborate</h6>
              <p class="mt-2 mb-4 text-gray-600">
                Add you colleagues and workers to your project.
              </p>
            </div>
          </div>
        </div>
        <div class="pt-6 w-full md:w-4/12 px-4 text-center">
          <div
            class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
          >
            <div class="px-4 py-5 flex-auto">
              <div
                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-green-400"
              >
                <i class="fas fa-retweet"></i>
              </div>
              <h6 class="text-xl font-semibold">Log Results</h6>
              <p class="mt-2 mb-4 text-gray-600">
                Log your test results with ease and keep testing !
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="flex flex-wrap items-center mt-32">
        <div class="w-full md:w-5/12 px-4 mr-auto ml-auto">
          <div
            class="text-gray-600 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-gray-100"
          >
            <i class="fas fa-user-friends text-xl"></i>
          </div>
          <h3 class="text-3xl mb-2 font-semibold leading-normal">
            Working with eagle tracker comes with ease
          </h3>
          <p
            class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700"
          >
            Simplicity is our goal. It is easy to get started with our tracker rather than creating complex
            spreadsheet for logging test results.
          </p>
          <p
            class="text-lg font-light leading-relaxed mt-0 mb-4 text-gray-700"
          >
            Our sheet is relatively easy to use especially for small projects that do not require complex 
            spreadsheet. You can also export your test results to a traditional spreadsheet 
          </p>
          <a
            href="{{ route('login') }}"
            class="font-bold text-gray-800 mt-8"
            >Get started !</a
          >
        </div>
        <div class="w-full md:w-4/12 px-4 mr-auto ml-auto">
          <div
            class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg bg-pink-600"
          >
            <img
              alt="..."
              src="/images/about.jpg"
              class="w-full align-middle rounded-t-lg"
            />
            <blockquote class="relative p-8 mb-4">
              <svg
                preserveAspectRatio="none"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 583 95"
                class="absolute left-0 w-full block"
                style="height: 95px; top: -94px;"
              >
                <polygon
                  points="-30,95 583,95 583,65"
                  class="text-pink-600 fill-current"
                ></polygon>
              </svg>
              <h4 class="text-xl font-bold text-white">
                Top Notch Services
              </h4>
              <p class="text-md font-light mt-2 text-white">
                The Arctic Ocean freezes every winter and much of the
                sea-ice then thaws every summer, and that process will
                continue whatever happens.
              </p>
            </blockquote>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="#contactdev" class="pt-20 pb-48">
    <div class="container mx-auto px-4">
      <div class="flex flex-wrap justify-center text-center mb-24">
        <div class="w-full lg:w-6/12 px-4">
          <h2 class="text-4xl font-semibold">Here's the developer</h2>
        </div>
      </div>
      <div class="flex flex-wrap justify-center">
        <div class="w-full md:w-6/12 lg:w-3/12 lg:mb-0 mb-12 px-4">
          <div class="px-6">
            <img
              alt="..."
              src="/images/4.jpg"
              class="shadow-lg rounded-full max-w-full mx-auto"
              style="max-width: 120px;"
            />
            <div class="pt-6 text-center">
              <h5 class="text-xl font-bold">Adeola Oluwadunsin Bada</h5>
              <p class="mt-1 text-sm text-gray-500 uppercase font-semibold">
                Software Developer
              </p>
              <div class="mt-6">
                <button
                  class="bg-blue-400 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1"
                  type="button"
                >
                  <i class="fab fa-linkedin"></i></button
                >
                <button
                  class="bg-blue-400 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1"
                  type="button"
                >
                  <i class="fab fa-instagram"></i></button
                >
                <button
                  class="bg-blue-400 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1"
                  type="button"
                >
                  <i class="fab fa-twitter"></i></button
                ><button
                  class="bg-blue-600 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1"
                  type="button"
                >
                  <i class="fab fa-facebook-f"></i></button
                ><button
                  class="bg-pink-500 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1"
                  type="button"
                >
                  <i class="fab fa-dribbble"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="pb-20 relative block bg-gray-900">
    <div
      class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20"
      style="height: 80px; transform: translateZ(0px);"
    >
      <svg
        class="absolute bottom-0 overflow-hidden"
        xmlns="http://www.w3.org/2000/svg"
        preserveAspectRatio="none"
        version="1.1"
        viewBox="0 0 2560 100"
        x="0"
        y="0"
      >
        <polygon
          class="text-gray-900 fill-current"
          points="2560 0 2560 100 0 100"
        ></polygon>
      </svg>
    </div>
    <div class="container mx-auto px-4 lg:pt-24 lg:pb-64">
      <div class="flex flex-wrap text-center justify-center">
        <div class="w-full lg:w-6/12 px-4">
          <h2 class="display-4 my-auto font-semibold text-white">Now Build something Great !</h2>
        </div>
      </div>
    </div>
  </section>
  @include('components.guest-footer')
</main>
{{-- Main content ends --}}
@endsection