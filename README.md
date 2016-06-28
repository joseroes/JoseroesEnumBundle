
#Enumerations as a Service Bundle
*by Joseroes https://github.com/joseroes/ .*

This bundle was born as a technical need I had in PHP.  As a Java Developer, I'm used to have enumerations, but PHP doesn't allow this kind of data type. Well, it does, but only if you use Doctrine and only is you use MySQL. This is an DB engine and ORM/ODM agnostic enumerations bundle, just like the ones we have in Java and many other programming languages.

##Installation
Add 
`new Joseroes\EnumBundle\EnumBundle()`, to `AppKernel.php`

##Configuration
Compatible with Symfony2 2.X

Doctrine compatible no matter the database engine you're using. This bundle is completelly agnostic of the technology you're using for data access. It only lives in the Entity/Document level.

##How to use
Create a class extending BasicEnum class from Joseroes\EnumBundle, with the list of values you want to enumerate like this:
```
use Joseroes\EnumBundle\Entity\BasicEnum;
class GenderEnum extends BasicEnum
{
    const NONE = 0;
    const MALE = 1;
    const FEMALE = 2;
}
```
Values can also be strings:
```
class RoleEnum extends BasicEnum
{
    const ROLE_USER = "ROLE_USER";
    const ROLE_SALES = "ROLE_SALES";
    const ROLE_ADMIN = "ROLE_ADMIN";
    const ROLE_SUPER_ADMIN = "ROLE_SUPER_ADMIN";
}
```

Then report your enums as a service in your service.yml file (XML or annotations)
```
services:
  gender_enum:
    class: AppBundle\Entity\enums\GenderEnum
    arguments: []
  role_enum:
    class: AppBundle\Entity\enums\RoleEnum
    arguments: []
```

Last step is to add translations for every enum value you have:
```
enum:
  gender_enum:
    NONE: No specified
    MALE: Male
    FEMALE: Female

  role_enum:
    ROLE_USER: User
    ROLE_SALES: Salesman
    ROLE_ADMIN: Administrator
    ROLE_SUPER_ADMIN: Super Administrator (All Permissions Granted)
```

###In any other service, controller or repository
```
Enum::key
Enum::getValue($key)
```


###In the template
```
<td>{{ entity.gender | enum('Gender') }}</td>
```
This will display the binding value in entity.gender.

###In a form as choise array for a selection widget (Form is container aware)
```
'choices' => $this->container->get('enum')->getTranslatorConstants('Gender')
```