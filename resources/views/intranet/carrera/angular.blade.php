<!DOCTYPE html>
<html lang="en" ng-app='test'>
<head>
	<meta charset="UTF-8">
	<title>Prueba angular</title>
	<script src="{{ asset('js/competencia/angular/angular.min.js') }}"></script>
	<script src="{{ asset('js/competencia/prueba.js') }}"></script>
</head>
<body>
	
	<div ng-controller="testController">
		<input type="text" ng-model='prueba'>
		<div>
			@{{ prueba }}
		</div>
	</div>

</body>
</html>
