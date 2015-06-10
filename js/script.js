    $(document).ready(function() {
    $('#postBookForm')
        .bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                bookname: {
                    message: 'The Book Title  is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Book Title is required'
                        },    
                    }
                },
                 bookdesc: {
                    message: 'The Book description  is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Book description is required'
                        },
                        stringLength: {
                            min: 6,
                            max: 300,
                            message: 'The Book description  must be more than 6 and less than 300 characters long'
                        },    
                    }
                },
                category: {
                    message: 'The category name  is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The category name is required'
                        }    
                    }
                },
                ISBNNumber: {
                    message: 'The ISBN Number is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The ISBN Number is required'
                        },
                        stringLength: {
                            min: 6,
                            max: 8,
                            message: 'The ISBN Number must be more than 6 and less than 8 characters long'
                        },    
                    }
                },
                price: {
                    message: 'The Price is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Price is required'
                        }    
                    }
                },
                bookImage: {
                          validators: {
                            notEmpty: {
                                message: 'Book Image is required'
                            },
                            file: {
                                    extension: 'png',
                                    type: 'image/png',
                                    message: 'The selected file is not valid, or the size is having problem!'
                                }
                          }
                }
            }
        })
        .on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
            var $form = $(e.target);
            var data = new FormData();
             data.append('bookname', $("#bookname").val());
             data.append('bookdesc', $("#bookdesc").val());
             data.append('category', $('#category').val());
             data.append('ISBNNumber', $('#ISBNNumber').val());
             data.append('price', $('#price').val());

            jQuery.each(jQuery('#bookImage')[0].files, function(i, file) {
                data.append('file-'+i, file);
            });

            jQuery.ajax({
            url: $form.attr('action'),
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(data){
                $('#loginModal').modal('hide');
                alert(data);
               $(location).attr('href',"home.php");
            }
          });
        });


    $('#loginForm')
        .bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                login_username: {
                    message: 'The Email is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Email is required'
                        } ,
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'The value is not a valid email address'
                        }
                  }
                },  
                 login_password: {
                    message: 'The password  is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        },
                        regexp: {
                            regexp: "((?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{6,20})",
                            message: 'The password must consists of 6-20 length with atleast one number, Uppercase and Lowercase letters'
                        },    
                    }
                }
            }
        })
        .on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), 'json').done(function (data, textStatus, jqXHR) {
            // some code goes here
                var returnedData = $.parseJSON(data); 
                if (returnedData['status'] == 0) {
                    if ( returnedData['isAdmin'] == 1) {
                        if(confirm("Would you like to Login as ADMIN?")){
                             $(location).attr('href',"admin.php");
                        }else {
                            $(location).attr('href',"home.php");
                        }
                       
                    } else{
                         $(location).attr('href',"home.php");
                    };
                   
                } else{

                };
               // alert(returnedData['message']);
              }).fail(function () {
                  // some code goes here
              });
        });

        $('#registerForm')
        .bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                firstname: {
                    message: 'The First Name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The First Name is required'
                        } 
                  }
                },
                lastname: {
                    message: 'The Last Name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Last Name is required'
                        } 
                  }
                },
                sid: {
                    message: 'The Student Id is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Student Id is required'
                        } 
                  }
                }, 
                email: {
                    message: 'The Email Address is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Email Address is required'
                        },  
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'The value is not a valid email address'
                        }
                  }
                },

                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required and cannot be empty'
                        },
                        different: {
                            field: 'firstname',
                            message: 'The password cannot be the same as firstname'
                        },regexp: {
                            regexp: "((?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{6,20})",
                            message: 'The password must consists of 6-20 length with atleast one number, Uppercase and Lowercase letters'
                        },  
                    }
                },
                confirmPassword: {
                      validators: {
                          notEmpty: {
                              message: 'The confirm password is required and cannot be empty'
                          },
                          identical: {
                              field: 'password',
                              message: 'The password and its confirm are not the same'
                          },
                          different: {
                              field: 'firstname',
                              message: 'The password cannot be the same as firstname'
                          }
                      }
                  },
            }
        })
        .on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), 'json').done(function (data, textStatus, jqXHR) {
            // some code goes here
                 alert(data);
                 $(location).attr('href',"home.php");
              }).fail(function () {
                  // some code goes here
              });
        });

        $('#addCatForm')
        .bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                catName: {
                    message: 'The Category Title  is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Category Title is required'
                        },    
                    }
                }
                 
            }
        })
        .on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), 'json').done(function (data, textStatus, jqXHR) {
            // some code goes here
                 $("#addModal").modal('hide');
                 alert(data);
                // $(location).attr('href',"admin.php");
                loadAjaxCats(0);    
              }).fail(function () {
                  // some code goes here
              });
        });
});