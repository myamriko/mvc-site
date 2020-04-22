var myEditorEdit;

ClassicEditor
    .create(document.querySelector('#editorEdit'), {
        highlight: {
            options: [
                {
                    model: 'yellowMarker',
                    class: 'marker-yellow',
                    title: 'Yellow marker',
                    color: 'var(--ck-highlight-marker-yellow)',
                    type: 'marker'
                },
                {
                    model: 'greenMarker',
                    class: 'marker-green',
                    title: 'Green marker',
                    color: 'var(--ck-highlight-marker-green)',
                    type: 'marker'
                },
                {
                    model: 'pinkMarker',
                    class: 'marker-pink',
                    title: 'Pink marker',
                    color: 'var(--ck-highlight-marker-pink)',
                    type: 'marker'
                },
                {
                    model: 'blueMarker',
                    class: 'marker-blue',
                    title: 'Blue marker',
                    color: 'var(--ck-highlight-marker-blue)',
                    type: 'marker'
                },
                {
                    model: 'redPen',
                    class: 'pen-red',
                    title: 'Red pen',
                    color: 'var(--ck-highlight-pen-red)',
                    type: 'pen'
                },
                {
                    model: 'greenPen',
                    class: 'pen-green',
                    title: 'Green pen',
                    color: 'var(--ck-highlight-pen-green)',
                    type: 'pen'
                }
            ]
        },
        fontColor: {
            colors: [
                {
                    color: 'hsl(0, 75%, 60%)',
                    label: 'Red'
                },
                {
                    color: 'hsl(30, 75%, 60%)',
                    label: 'Orange'
                },
                {
                    color: 'hsl(60, 75%, 60%)',
                    label: 'Yellow'
                },
                {
                    color: 'hsl(90, 75%, 60%)',
                    label: 'Light green'
                },
                {
                    color: 'hsl(120, 75%, 60%)',
                    label: 'Green'
                },
                {
                    color: 'hsl(0, 0%, 0%)',
                    label: 'Black'
                },
                {
                    color: 'hsl(0, 0%, 30%)',
                    label: 'Dim grey'
                },
                {
                    color: 'hsl(0, 0%, 60%)',
                    label: 'Grey'
                },
                {
                    color: 'hsl(0, 0%, 90%)',
                    label: 'Light grey'
                },
                {
                    color: 'hsl(0, 0%, 100%)',
                    label: 'White',
                    hasBorder: true
                },
            ]
        },
        fontSize: {
            options: [
                'tiny',
                'small',
                'default',
                'big',
                'huge'
            ]
        },
        alignment: {
            options: ['left', 'right', 'center', 'justify']
        },

        ckfinder: {
            uploadUrl: '/libs/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
        },

        toolbar: ['ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', 'underline', 'subscript', 'superscript', '|', 'alignment', 'fontSize', 'fontColor', 'highlight', '|', 'undo', 'redo', '|', 'insertTable', 'link', '|',
            'bulletedList', 'numberedList', 'blockQuote']
    })
    .then( editorEdit => {
        myEditorEdit = editorEdit;
    } )
    .catch(error => {
        console.error(error);
    });