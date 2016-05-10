(function() {
    Dropzone.options.fileupload = {

        paramName:"files", // The name that will be used to transfer the file
        maxFilesize:50, // MB
        maxFiles:1,
        thumbnailWidth:"300",
        thumbnailHeight:"300",
        dictDefaultMessage:"Drop File here or Click to upload a file",
        init: function() {
            this.on("maxfilesexceeded", function(file) {
                this.removeFile(file);
            });
        },
        accept:function(file, done) {
            done()
        },

        success:function(data, file) {
            var messageContainer    =   $('.dz-success-mark'),
                inputContainer      =   $('<div class = "input-group dl-input"></div>'),
                message             =   $('<p class = "successmsg">File Uploaded Successfully! Click copy to get your download link!<br></p>'),
                button              =   $('<button></button>', {
                    'type'  : 'button',
                    'class' : 'btn copy-btn',
                    'data-clipboard-action': 'copy',
                    'data-clipboard-target' : 'input#dl-copy',
                    'text'  : 'Copy'

                }),
                imagePath           =   $('<input>', {
                    'id' : 'dl-copy',
                    'value' : JSON.parse(file).original_path,
                    'readonly' : true
                })

            $('.dropzone').removeClass('dz-clickable'); // remove cursor
            $('.dropzone')[0].removeEventListener('click', this.listeners[1].events.click);
            imagePath.addClass('dl-link');
            button.appendTo(inputContainer);
            imagePath.appendTo(inputContainer);
            inputContainer.appendTo(message);
            message.appendTo(messageContainer);
            messageContainer.addClass('show');
            $('.dz-error-mark').hide();
            $('.dz-preview').removeClass('dz-preview');

        },

        complete:function(data) {
            if(data.status != "success")
            {
                var error_message   =   $('.dz-error-mark'),
                    message         =   $('<p></p>', {
                        'text' : 'File Upload Failed'
                    });

                message.appendTo(error_message);
                error_message.addClass('show');
                return;
            }
        }
    };
})();