<div class="topic">
  <div class="title">{{$topic->title}}</div>
  <div class="subtopics-container">
    @foreach ($topic->subtopics as $subtopic)
        @include('landing.subtopic', ['subtopic' => $subtopic])
    @endforeach
  </div>
</div>