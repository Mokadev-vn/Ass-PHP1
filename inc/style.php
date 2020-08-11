<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
<style>
    .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .button-upload {
        border: 2px solid gray;
        color: gray;
        background-color: white;
        padding: 26px 45px;
        border-radius: 8px;
        font-size: 30px;
        font-weight: bold;
    }

    .upload-btn-wrapper input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
    }

    .remove-img {
        position: absolute;
        top: 0;
        right: 0;
        color: #1f1f1f;
    }

    .format {
        width: 600px;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }

    .format-product {
        width: 400px;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }

    .name-product{
        width: 150px;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }
</style>