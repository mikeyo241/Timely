<?php
echo <<< HTML
<html lang="en">

<head>
    <meta name="author" content="Michael Gardner" />
    <meta name="owner" content="Timely" />
    <meta name="description" content="On-Demand Delivery from anywhere!">
    <meta name="keywords" content="Get what you need in 2 hours!">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" />
</head>
<body>
    <header>
        <h1>Timely</h1>
    </header>
    <div id="login" name="login">
        <form>
            <table id="loginTable">
            <tbody>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input maxlength="40" type="email" name="logEmail" id="logEmail"></td>
                </tr>
                <tr>
                    <td><label for="password">Password</label></td>
                    <td><input maxlength="100" type="password" name="logPWord" id="logPWord"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="loginSubmit" value="Login"></td>
                </tr>
</form>
    </div>
    <div id="create" name="create">
        <table id="createTable">
            <tr>
                <td><input maxlength="40" type="text" name="fName" id="fName" placeholder="First Name"></td>
                <td><input maxlength="40" type="text" name="lName" id="mName" placeholder="Middle Name"></td>
                <td><input maxlength="40" type="text" name="lName" id="lName" placeholder="Last Name"></td>
            </tr>
            <tr>
                <td colspan="2"><label for="birthMonth">Birthday: </label>
                    <select name="birthMonth" id="birthMonth">
                        <option selected value=''>--Select Month--</option>
                        <option value='1'>Janaury</option>
                        <option value='2'>February</option>
                        <option value='3'>March</option>
                        <option value='4'>April</option>
                        <option value='5'>May</option>
                        <option value='6'>June</option>
                        <option value='7'>July</option>
                        <option value='8'>August</option>
                        <option value='9'>September</option>
                        <option value='10'>October</option>
                        <option value='11'>November</option>
                        <option value='12'>December</option>                 
                    </select>                                
                    <input maxlength="2" name="birthDay" id="birthDay" style="width: 20px; padding: 2px;">
                    <input maxlength="4" name="birthYear" id="birthYear" style="width: 60px;">
                </td>
            </tr>
            <tr>
                <td colspan="2"><input maxlength="40" type="text" name="address" id="address" placeholder="Address" style="width: 100%"> </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input maxlength="40" type="text" name="city" id="city" placeholder="City">
                    <select>
	                    <option value="AL">Alabama</option>	        <option value="AK">Alaska</option>          <option value="AZ">Arizona</option>
	                    <option value="AR">Arkansas</option>        <option value="CA">California</option>      <option value="CO">Colorado</option>
	                    <option value="CT">Connecticut</option>     <option value="DE">Delaware</option>        <option value="DC">District Of Columbia</option>
	                    <option value="FL">Florida</option>         <option value="GA">Georgia</option>         <option value="HI">Hawaii</option>
	                    <option value="ID">Idaho</option>           <option value="IL">Illinois</option>        <option value="IN">Indiana</option>
	                    <option value="IA">Iowa</option>            <option value="KS">Kansas</option>          <option value="KY">Kentucky</option>
	                    <option value="LA">Louisiana</option>       <option value="ME">Maine</option>           <option value="MD">Maryland</option>
	                    <option value="MA">Massachusetts</option>   <option value="MI">Michigan</option>        <option value="MN">Minnesota</option>
                    	<option value="MS">Mississippi</option>     <option value="MO">Missouri</option>        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>        <option value="NV">Nevada</option>          <option value="NH">New Hampshire</option>
	                    <option value="NJ">New Jersey</option>      <option value="NM">New Mexico</option>      <option value="NY">New York</option>
	                    <option value="NC">North Carolina</option>  <option value="ND">North Dakota</option>    <option value="OH">Ohio</option>
	                    <option value="OK">Oklahoma</option>        <option value="OR">Oregon</option>          <option value="PA">Pennsylvania</option>    <option value="RI">Rhode Island</option>
	                    <option value="SC">South Carolina</option>  <option value="SD">South Dakota</option>    <option value="TN">Tennessee</option>       <option value="TX">Texas</option>
	                    <option value="UT">Utah</option>            <option value="VT">Vermont</option>         <option value="VA">Virginia</option>        <option value="WA">Washington</option>
	                    <option value="WV">West Virginia</option>   <option value="WI">Wisconsin</option>       <option value="WY">Wyoming</option>
                    </select>
                    <input maxlength="5" type="text" name="zip" id="zip" placeholder="Zip-Code" style="width: 60px">
                </td>
            </tr>
            <tr>
                    <td><input maxlength="40" type="email" name="createEmail" id="createEmail" placeholder="Email"></td>
                    <td><input maxlength="40" type="email" name="createEmail" id="cfEmail" placeholder="Confirm Email"></td>
                </tr>
                
                <tr>
                    <td><input maxlength="100" type="password" name="createPWord" id="createPWord" placeholder="Password"></td>
                    <td><input maxlength="100" type="password" name="createPWord" id="cfPWord" placeholder="Confirm Password"></td>
                </tr>
            
</tr>
</table>
    
    </div>
</body>

</html>




HTML;
