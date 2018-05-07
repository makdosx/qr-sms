<?php

/*
 * Copyright (c) 2017-2018 Barchampas Gerasimos <makindosx@gmail.com>
 * QR-sms is a sms getaway with qrcode for verification (etc).
 *
 * QR-sms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 *
 * QR-sms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */


?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Example - example-ng-submit-production</title>
  

  <script src="//code.angularjs.org/snapshot/angular.min.js"></script>

  
</head>



<body ng-app="submitExample">
  <script>
  angular.module('submitExample', [])
    .controller('ExampleController', ['$scope', function($scope) {
      $scope.list = [];
      $scope.text = '[1]';
      $scope.submit = function() {
        if ($scope.text) {
          $scope.list.push(this.text);
          $scope.text = '';
        }
      };
    }]);
</script>



<form ng-submit="submit()" ng-controller="ExampleController">

  <input type="text" ng-model="text" name="text"  disabled="disabled"/>

  <input type="submit" id="submit" value="Submit" />
  <pre>list={{list}}</pre>
</form>


</body>
</html>
