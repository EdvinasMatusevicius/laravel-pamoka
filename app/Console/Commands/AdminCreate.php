<?php

namespace App\Console\Commands;

use App\Roles;
use App\Services\AdminService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Throwable;

class AdminCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create admin admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    private $adminService;

    public function __construct(AdminService $adminService)
    {
        parent::__construct();
        $this->adminService = $adminService;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle():void
    {

        $roleId=$this->getRoleId();
        $email = $this->enterEmail();
        $password=$this->enterPassword();

        $admin=$this->adminService->create($email,$password,true);


        $admin->roles()->sync([$roleId]);

        $this->info('admin created');

    }
 
    private function enterEmail():string{
        $email=$this->ask('Enter admin email');
        $validator=Validator::make(['email'=>$email],[
            'email'=>'required|email|unique:admins|max:255'
        ]);
        if($validator->fails()){
            $this->error($validator->errors()->first('email'));
            return $this->enterEmail();
        }
        return $email;
    }

    private function enterPassword():string{
        $password= $this->secret('Enter admin password');
        $passwordConfirm = $this->secret('Repeat admin password');

        $validator=Validator::make([
            'password'=>$password,
            'password_confirmation'=>$passwordConfirm
        ],[
            'password'=>'required|confirmed|min:8'
        ]);
        if($validator->fails()){
            $this->error($validator->errors()->first('password'));
            return $this->enterPassword();
        }
        return $password;
    }

    private function getRoleId(): int {
        $newRoleCreate = 'Create new';


        $roles = Roles::query()
        ->orderBy('id')->
        pluck('name','id');

        $role = $this->choice(
            'whitch role set to admin user?',
        array_merge([$newRoleCreate],$roles->toArray())
    );
        if($role !== $newRoleCreate){
            return (int)$roles->search($role);
        }
        return $this->createRole();
    }

    
    private function createRole(): int
    {
        $name = $this->getRoleName();
        $description = $this->getRoleDescription();
        $fullAccess = $this->getRoleFullAccess();
        $accessibleRoutes = [];

        try {
            $role = new Roles();

            $role->name = $name;
            $role->description = $description;
            $role->full_access = $fullAccess;
            $role->accessible_routes = $accessibleRoutes;

            $role->saveOrFail();

            return $role->id;
        } catch (Throwable $exception) {
            $this->error($exception->getMessage());

            return $this->createRole();
        }
    }


    private function getRoleName(): string
    {
        $name = $this->ask('Enter new Role name');

        $validator = Validator::make([
            'name' => $name,
        ], [
            'name' => 'required|string|min:3|max:100|unique:roles',
        ]);

        if ($validator->fails()) {
            $this->error($validator->errors()->first('name'));

            return $this->getRoleName();
        }

        return $name;
    }

    /**
     * @return string|null
     */
    private function getRoleDescription(): ?string
    {
        $description = $this->ask('Enter Role description or not');

        $validator = Validator::make([
            'description' => $description,
        ], [
            'description' => 'nullable|max:1000',
        ]);

        if ($validator->fails()) {
            $this->error($validator->errors()->first('description'));

            return $this->getRoleDescription();
        }

        return $description;
    }

    /**
     * @return bool
     */
    private function getRoleFullAccess(): bool
    {
        return $this->confirm('Has Role full access?', false);
    }
}
