# Attributes
Products Attributes

Add this to resources/assets/typicms/app.js:

    if (moduleName === 'attribute-groups' && action === 'edit') {
        moduleName = 'attributes';
    }

Run 
gulp js-admin