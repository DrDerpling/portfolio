@php
    use App\Modules\Skill\Models\Skill;
    /**
    * @var Skill $skill
    */
@endphp

<div>
    <div class="card">
        <div class="card-header">
            <h3>{{ $skill->name }}</h3>
        </div>
        <div class="card-body">
            <p>{{ $skill->proficiency }}</p>
        </div>
    </div>
</div>
