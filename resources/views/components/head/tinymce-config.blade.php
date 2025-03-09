<div>
    <script>
      tinymce.init({
        selector: '.{{ $selector }}' , // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'code table lists image',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image'
      });
    </script> 
</div>