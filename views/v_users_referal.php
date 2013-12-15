<form method='POST' action= <?php if(isset($tale_id)) echo '/users/p_referal/'.$tale_id; ?>>


    <?php if(isset($tale_id)) echo '/users/p_referal/'.$tale_id; ?>

    First Name<br>
    <input type='text' name='name'>
    <br><br>

    Email<br>
    <input type='text' name='email'>
    <br><br>

    Password<br>
    <input type='password' name='password'>
    <br><br>

    <input type='submit' value='Sign up'>

</form>