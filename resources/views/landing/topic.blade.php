<div class="topic">
  <div class="title">{{$topic->title}}</div>
  <div style="display: flex; flex-direction: column" class="subtopics-container">
    @foreach ($topic->subtopics as $subtopic)
        @include('landing.subtopic', ['subtopic' => $subtopic])
    @endforeach
    <form action="api/subtopics" method="post" style="align-self: center">
      <input type="text" name="title" placeholder="Insira o título do subtópico">
      <input name="owner_topic" value="{{$topic->id}}" hidden>
      <button type="submit">Criar</button>
    </form>
  </div>
</div>
