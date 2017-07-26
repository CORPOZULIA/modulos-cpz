<p>
	Id: {{$id}} <br>
	<ul>
		 @for($i = 0; $i<=3; $i++)
		 	<li>
		 		<a href="{{ url('producto/'.$i) }}">
		 			Producto {{ $i }} 
		 		</a> 
		 	</li>
		 @endfor
	</ul>
</p>