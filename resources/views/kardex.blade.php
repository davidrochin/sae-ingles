@extends('layouts.app')
@section('title', 'Kardex')
@section('section', 'Kardex')

@section('content')

		@slot('body')

	 <table class="table table-hover text-left">

      
        <tbody>
     
            <tr>
                <td>Alumno:<strong> Oswaldo Guevara Sanchez</strong></td>
                <td>No. Control:<strong> 14440600</strong></td>
               
            </tr>
            <tr>
                <td>Carrera:<strong> Ing. Informatica</strong><strong></td>
                <td>Fecha:<strong> 03/04/2019</strong></td>
               
            </tr>
           
     
        </tbody>

    </table>	

  @include('tables.kardex')
@endsection
