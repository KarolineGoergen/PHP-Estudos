<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Eixo;
use App\Policies\EixoPolicy;
use App\Models\Curso;
use App\Policies\CursoPolicy;
use App\Models\Professor;
use App\Policies\ProfessorPolicy;
use App\Models\Aluno;
use App\Policies\AlunoPolicy;
use App\Models\Disciplina;
use App\Policies\DisciplinaPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
       Eixo::class => EixoPolicy::class,
       Professor::class => ProfessorPolicy::class,
       Aluno::class => AlunoPolicy::class,
       Curso::class => CursoPolicy::class,
       Disciplina::class => DisciplinaPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
