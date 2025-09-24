1. You are transitioning maintenance of a Magento build to a content manager. One question she asks you is how can she add a sale banner (widget) to every page on the website? Keeping simplicity in mind, what is your answer?

a. Add a Javascript snippet into Content Design Configuration
b. Add the widget through the Content> Widgets menu
c. Write a code customization to display a widget on every page
d. Purchase a 3rd-party module

2. The client has issued an Offline credit memo for a customer. The customer has called in to complain that they have not received the refund. Why is this?

a. The offline credit memo can only be applied to store credit, which is done automatically.
b. Offline credit memos do not automatically refund the customer
c. The customer needs to wait three to four business days for the money to be refunded.
d. The client must not have hit the refund button when creating the credit memo

3. You are working on a module MyCompany_ModuleA and created a layout update which updates a block introduced in Magento_Catalog. What step is required to ensure that the layout update is applied properly?

a. Run bin/magento setup upgrade to get your module placed automatically after Magento Catalog in etc/config.php
b. You should add <sequence> <module name "Magento_Catalog"/> </sequence> to your etc/module.xml
c. Magento will figure out the right order of loading layout files so no extra steps are required
d. You should include the layout file that defines a block into your custom layout file using update> instruction.

4. You are building an admin grid for your custom entity. You expect the module you're developing will be widely used and other developers may want to customize the grid. You want to make sure they can use Modifiers framework. Keeping simplicity and maintainability in mind, how do you enable the use of Modifiers in your custom grid?

a. There is a special DataProvider class that your DataProvider has to extend: Magento\UnDataProvider ModifierPoolDataProvider Make sure your DataProvider extends the standard Magento\DataProvider AbstractDataProvider

b. Magento does not support Modifiers for grids only for forms.
c. You need to develop the functionality from scratch and properly document it in the manual that is shipping along with the extension Modifiers only work for Catalog entities, so you must extend your DataProvider from the Magento\Catalog\U\DataProvider\Product ProductDataProvider

5. You are tasked with adding an additional comma" into the address template that is sent in the email. Keeping maintainability in mind, how do you do this?

a. Create a plugin for the Magento\Sales\Order Address getFormatted method
b. Use dixml to add a new address formatter to Magento\Sales\Model Order\Address\Formatter List class
c. Set the new template in etc/order_addresses.xml
d. Change the address template in store configuration

6. You have a task to customize an existing form for a core's entities. You have to change a configuration for one of the fields. How do you do that. keeping simplicity in mind?
   a. Create a file view/adminhtml/i_component/<form name xml with the only field node that must be changed. This file will be merged with the original one.
   b. Create a JavaScript mixin to the form is component which is only trigerred for a given form. Find the equired field's configuration and modify it.
   c. Override the original uiComponent's configuration xml file completely and make the necessary change
   d. Create a plugin for UilComponentFormField getMeta method and modify the configuration for the required form and field

7. What is the difference between setting cacheable="false" on a block in layout XML attribute and the block's getCacheLifetime() == null? cacheable="false" affects the parent block or container getCacheLifetime() == null?

8. You have created a new Events module with the custom functionality of allowing admin users to populate a calendar in the admin with upcoming events for their business. There is an ACL rule, admin menu item, and a few controllers built for it. You wish to apply the new ACL restriction to your controllers, which all extend the Magento\Backend\App\Action class. Keeping efficiency and maintainability in mind, choose the two ways you can add your custom ACL role to your controller Choose 2

a. Create an around plugin for this class Magento\Framework\Authorization isAllowed) and add in the required logic
b. Inside your controller class, override the constant ADMIN RESOURCE variable and update it with your ACL resource
c. Create a preference for the Magento Framework Authorization class and inside your new class add in the required logic
d. Override the isAllowed function inside your controller protected function_isAllowed) [return Stris_authorization isAllowSwiftOtter Calendar manage

9. You have created a new table and are now working on implementing CRUD operations. In the future, you will be using after commit callbacks. Which Magento class do you have to implement to get this functionality out of the box?

a. ResourceModel extending Magento\Framework\Model\ResourceModel\Db\AbstractDb
b. Model extending Magento\FrameworkModellAbstractModel
c. After commit callback, is a stored procedure in MySQL, so you should add a special DataPatch class extending Magento\Framework\Setup\Patch\AfterCommitCallbackinterface
d.Repository which is using Magento\Framework Persistor Transactional in its save method

this are some past questions in the exam. this questions are extracted from a low quality images and there can be mistakes in it.
