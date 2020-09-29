<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $(document).on('change', '.addGallery', function (event) {
            var tmppath = URL.createObjectURL(event.target.files[0]);
            var divImg = $(this).parent().parent();
            $(this).parent().hide();
            console.log(divImg);
            divImg.append('<div class="d-block mb-4 h-100 position-relative"><img style="height: 100px; width: 130px" src="'+ tmppath+'" alt=""><a href="#" class="remove-img"><i class="fas fa-times-circle"></i></a></div>');
            $("#galleries").append('<div class="col-lg-3 col-md-3 col-4"><div class="upload-btn-wrapper"><button class="button-upload"><i class="fas fa-plus-circle"></i></button><input type="file" name="galleries[]" class="addGallery" /></div></div>');
        });

        $(document).on('click', '.remove-img', function(){
            var id = $(this).attr('id');
            var valueId = $("input[name='removeGalleries']").val();
            $("input[name='removeGalleries']").val(valueId +','+ id);
            console.log(id);
            $(this).parent().parent().remove();
        });
    });
</script>
</body>

</html>