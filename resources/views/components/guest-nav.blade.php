<nav
class="top-0 absolute z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 navbar-expand-lg"
>
<div
  class="container px-4 mx-auto flex flex-wrap items-center justify-between"
>
  <div
    class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start"
  >
    <a
      class="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-no-wrap uppercase text-white"
      href="/"
      >Eagle Bug Tracker</a
    ><button
      class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
      type="button"
      onclick="toggleNavbar('example-collapse-navbar')"
    >
      <i class="text-white fas fa-bars"></i>
    </button>
  </div>
  <div
    class="lg:flex flex-grow items-center bg-grey-700  lg:bg-transparent lg:shadow-none hidden"
    id="example-collapse-navbar"
  >
    <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
      <li class="flex items-center bg-white">
        <a
          class="text-gray-800 lg:hover:text-gray-300 lg:text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
          href="#contactdev"
          ><span class="inline-block ml-2">Contact</span></a
        >
      </li>
      <li class="flex items-center bg-white">
        <a
          class="text-gray-800 lg:hover:text-gray-300 lg:text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
          href="{{ route('login') }}"
          ><span class="inline-block ml-2">Login</span></a
        >
      </li>
      <li class="flex items-center bg-white">
        <a
          class="text-gray-800 lg:hover:text-gray-300 lg:text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
          href="{{ route('register') }}"
          ><span class="inline-block ml-2">Signup</span></a
        >
      </li>
    </ul>
  </div>
</div>
</nav>
<script>
  function toggleNavbar(collapseID) {
      document.getElementById(collapseID).classList.toggle("hidden");
      document.getElementById(collapseID).classList.toggle("block");
  }
</script>