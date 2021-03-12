<div class="subtopic">
    <div class="title">
        <a href="">{{ $subtopic->title }}</a>
    </div>
    <div class="summary">
        {{ $subtopic->summary }}
    </div>
    <div class="last-post">
        <a href="">{{ $subtopic->posts[0]->body }}</a>
    </div>
</div>
