@extends('layout')
@section('content')
    <div class="bg-cyan-200 mx-auto w-[60%] rounded-md h-auto">
       <div class="p-6 flex flex-col justify-center items-center gap-3">
        <h1 class="text-3xl font-bold text-cyan-600">To-Do List</h1>
        <p class="text-cyan-600">QuickTask is a simple and efficient. This disigned to help you stay organized and boost productivity.</p>
        {{-- FORM INSERT TODO --}}
        <form class="w-full" method="POST" action="/insert">
            @csrf
          <div class="flex flex-col gap-3">
                <input type="text" name="title" class="border-none rounded-md p-2" placeholder="Todo List Title">
                @error('title')
                    <div class="">
                        <span class="text-red-700">{{$message}}</span>
                    </div>
                @enderror
                <textarea name="description" id="" cols="30" rows="5" placeholder="The todo description" class="border-none rounded-md p-2"></textarea>
                @error('description')
                    <div class="">
                        <span class="text-red-700">{{$message}}</span>
                    </div>
                @enderror
                <button  class="bg-cyan-400 p-2 rounded-lg text-cyan-600 hover:bg-cyan-500 hover:text-cyan-300 transition-colors">Add</button>
          </div>
        </form>
        <hr class="border border-spacing-1 border-cyan-500 my-3 w-full">
        {{-- TODO LIST --}}
        
            @foreach ($todos as $item)
            <div class="flex justify-between w-full">
            <div class="flex flex-col">
                <span @class(['text-cyan-600 font-bold ', $item->isDone ? 'line-through decoration-red-500 decoration-2': ''])>{{$item->title}}</span>
                <span @class(['text-cyan-600 font-bold', $item->isDone ? 'line-through decoration-red-500 decoration-2': ''])>{{$item->description}}</span>
            </div>
              <div class="flex gap-2">
               <form action={{route('done',$item->id)}} method="POST">
                @csrf
                <button class="bg-green-500 py-2 px-3 text-white rounded-lg hover:opacity-25">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                      </svg>
                      
                </button>
               </form>
               <form action={{route('cancel',$item->id)}} method="POST">
                @csrf
                <button class="bg-red-500 py-2 px-3 text-white rounded-lg hover:opacity-25">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                      </svg>
                      
                </button>
               </form>
              </div>
           
            </div>
            <hr class="border border-spacing-1 border-cyan-500 my-3 w-full">
            @endforeach
       </div>
      
    </div>
@endsection