# Laraver Tutorial For Beginners (Simple Use Crud App)

Source: [Laravel Tutorial For Beginners (Simple User CRUD App)](https://youtu.be/cDEVWbz2PpQ?list=TLPQMTQwNzIwMjNOvt_IvqvlAA) 

# Comandos
This arr the comand using in the diferent stage of project build.

### Creating new project

`composer create-project laravel/laravel` : Create a new project of Laraver using composer.
`php artisan serve`: Star server to show in a browser the page.

### Controllers

php artisan make:controller UserController
 
### validating from submit
```php
$request->validate([
    "name" => ["required", "string"],
    "email"=>["required","unique:users,email"] // unique validation for email column in
])
```
### Database
`php artisan migrate` : Gnerate all migration that still not running on the database.

### login and logout

`auth()->logout();`: Log the user out of the application..
`auth()->attempt(['user', 'password'])`: Attempt to authenticate a user using the given credentials..
`$request->session()->regenerate();` : Generate a new session identifier.

### Blog Post

`php artisan make:migration create_posts_table`: crate a new file on [database\migration\], It have the methods to execute the new table on the database. On this class we define the new fiels for the table. 

The field to tables are define this:
```php
 public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('tile');
            $table->longText('body');
            $table->foreignId('user_id')->constrained();
        });
    }
```

`php artisan migrate`: To execute the migration that still no execute.

`php artisan make:controller PostController`: crate a new controller.
`auth()->id`: Get the id of user, that is login. 

`php artisan make:model Post`: It is use to connect the table `posts` to de model in the code.

` protected $fillable = ['title', 'body', 'user_id'];`: before to create a post it necesary to indicate the field that must be a filled.

### Display Post
We need to create the realtionship whit tehe tabla Post inside the Model User. In this case the field `user_id` is use to link the two tables.
```php
  public function userCoolPost() {
        //return $this->hasMany(Post::class)->where('is_cool', true); //
        return $this->hasMany(Post::class, 'user_id'); //
    }
```
This example below show how to find through relationshop on the model User The post of a users.
In this case we are user teh method `auth()` to get de information that model `User`.
```php
    if (auth()->check()){
        $posts = auth()->user()->userCoolPost()->latest()->get();
        $userData = auth()->user()->name;
    }
    //$posts = Post::where('user_id', auth()->id())->get();
    //$posts = Post::all();
```

`auth()->check()` : Allow validate si the user has an active session.
`auth()->user()`: The class/method auth contain the instance of user that is login.

### Edit & Delet Post
We use this condition to validate that only the user in the session, can make the changes.
```php
 if (auth()->id() != $post['user_id']){
    return redirect('/');
}
```
`$post->delete();`: method to eliminate a post from a model in the database.

The next code in the `Post` model, allow get the information that user by each post.
```php
public function user(){
    return $this->belongsTo(User::class, 'user_id'); //one to many relationship with User model.
}
```