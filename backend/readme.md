



Field Description
-----------------

pages:
    
    example:
        
        type: module                    # (module|separator)    
        label: Example                  # name of the page
        params :
            table_name: sample                   # table name
            table_key: id                       # table index (default to 'id')
            table_order:   id                       # table index (default to 'id')
            table_where:   id                       # table index (default to 'id')

        fields:
            type : text
            name : name_of_table_field
            label : Human readable name
            description :

            value :
            no_insert : if true, don't show in list view
            no_update : 
            no_delete : 

            rules: required|alphanumeric
            rules_msg : Champ obligatoire
            format: "<strong>%s</strong>"
            format_edit:
            actions : export|duplicate

                            
            params :




Plugin API
----------

    getHtml ($field, $value)

    getHtmlDescription ($field, $value)

    prepareForDisplay ($field, $value)
    prepareForDB ($field, $value)

    preInsertHook ($field, $value)
    postInsertHook ($field, $value)
    preUpdateHook ($field, $value)
    postUpdateHook ($field, $value)
    preDeleteHook ($field, $value)
    postDeleteHook ($field, $value)

