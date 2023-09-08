window.Category = (function () {
    const form = document.getElementById("form");
    const submitButton = document.getElementById("submitButton");

    let typeForm = "store";
    let desc;
    let validator;

    return {
        setTypeForm: function (type) {
            typeForm = type;
        },

        isFormForStore: function () {
            return typeForm === "store";
        },

        storeRules: () => {
            return {
                'image': {
                    validators: {
                        notEmpty: {
                            message: "Image is required",
                        },
                    },
                },
                'name': {
                    validators: {
                        notEmpty: {
                            message: "Name is required",
                        },
                    },
                },
                'description': {
                    validators: {
                        callback: {
                            message: 'Description field is required',
                            callback: function (value) {
                                let text = desc.getContent({format: 'text'});
                                return text.length > 0;
                            }
                        }
                    }
                },
            };
        },

        updateRules: () => {
            return {
                'image': {
                    validators: {
                        notEmpty: {
                            message: "Image is required",
                        },
                    },
                },
                'name': {
                    validators: {
                        notEmpty: {
                            message: "Name is required",
                        },
                    },
                },
                'description': {
                    validators: {
                        callback: {
                            message: 'Description field is required',
                            callback: function (value) {
                                let text = desc.getContent({format: 'text'});
                                return text.length > 0;
                            }
                        }
                    }
                },
            };
        },

        initTinyMce: function () {
            tinymce.init({
                selector: 'textarea#description',
                menubar: false,
                statusbar: false,
                setup: function (editor) {
                    desc = editor;
                    editor.on('keyup', function () {
                        validator.revalidateField('description');
                    })
                }
            });
        },

        initFormValidation: function () {
            validator = FormValidation.formValidation(form, {
                fields: Category.isFormForStore()
                    ? Category.storeRules()
                    : Category.updateRules(),
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: "",
                    }),
                    icon: new FormValidation.plugins.Icon({
                        invalid: "fa fa-times",
                        validating: "fa fa-refresh",
                    }),
                },
            });
        },

        submitFormValidation: () => {
            let actionQuestion = Category.isFormForStore() ? "Add" : "Update";
            Swal.fire({
                title: `Are your sure to ${actionQuestion}?`,
                icon: "warning",
                confirmButtonText: "Yes",
                showCancelButton: true,
                confirmButtonColor: "#009EF7",
            }).then((result) => {
                if (!result.isConfirmed) {
                    // Remove loading indication
                    // submitButton.removeAttribute('data-kt-indicator');
                    //
                    // // Enable button
                    // submitButton.disabled = false;
                    return;
                }

                // Show loading indication
                submitButton.setAttribute("data-kt-indicator", "on");

                // Disable button to avoid multiple click
                submitButton.disabled = true;

                form.submit(); // Submit form
            });
        },

        initSubmitButton: function () {
            submitButton.addEventListener("click", function (e) {
                // Prevent default button action
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function (status) {
                        if (status === "Valid") {
                            Category.submitFormValidation();
                        }
                    });
                }
            });
        },

        init: function () {
            Category.initTinyMce();
            Category.initFormValidation();
            Category.initSubmitButton();
        },
    };
})();
