<!DOCTYPE html>
<html lang="en">
<body>
<style type="text/css">
	
.error-text{
	font-size: 25px;
	padding: 25px 0;
}
.text-danger {
    color: #a94442;
}
.text-center{
    text-align: center;
}
</style>
<main >
     <section class="login-panel">
        <div class="login-form text-center">
         
            <h4 class="text-danger error-text"><?=isset($message) ? $message : 'Error';?></h4>
        
          
        </div>
    </section>
</main>
</body>
</html>
