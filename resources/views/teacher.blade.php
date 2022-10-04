<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ホーム</title>
  <link rel="stylesheet" href="/css/reset.css">
  <link rel="stylesheet" href="/css/home.css">
</head>

<body>
  <header class="header">
    <div>ホーム画面</div>
    @if($teacher != null)
    <a href="/teacher/logout">先生用ログアウト</a>
    @else
    <a href="/logout">生徒用ログアウト</a>
    @endif
    @can('isManager')
    管理者
    @endcan
    @if($teacher-> role >= 2)
    先生
    @endif
  </header>
  <main>
    <div class="post_lists">
      <!-- 投稿表示 -->
      @foreach($posts as $post)
      <div class="post_list">
        <div class="post_hover">
          <div class="post_top">
            <span class="post_name">
              @if($post->teacher_id != null)
              {{$post->teacher->name}}
              @elseif($post->user_id != null)
              {{$post->user->name}}
              @endif
            </span>
            <span class="post_time">
              {{\Carbon\Carbon::parse($post->created_at)->format("m/d H:i")}}
            </span>
          </div>
          <!-- 解決ボタン -->
          @isset($teacher)
          @if($post->teacher_id != null)
          @if($post->teacher_id == $teacher->id)
          <form action="/post/check" method="post" class="post_solve">
            <input type="hidden" name="check" value="2">
            <input type="submit" value="解決した">
          </form>
          <form action="/post/delete" method="post">
            <input type="submit" value="削除">
          </form>
          <div class="edit">
            <a href="/edit">編集</a>
          </div>
          @endif
          @endif
          @endisset
          @isset($user)
          @if($post->user_id != null)
          @if($post->user_id == $user->id)
          <form action="/post/check" method="post" class="post_solve">
            <input type="hidden" name="check" value="2">
            <input type="submit" value="解決した">
          </form>
          <form action="/post/delete" method="post">
            <input type="submit" value="削除">
          </form>
          <div class="edit">
            <input type="button" value="編集" id="openBtn_{{$post->id}}" class="openBtn">
            <div class="modal" id="modal_{{$post->id}}">
              <div class="modal_content">
                <div class="modal_inner">
                  <form action="/post/edit" method="post">
                    <input type="text" name="text" value="{{$post->text}}">
                  </form>
                  <input type="button" id="closeBtn_{{$post->id}}" class="closeBtn">
                </div>
              </div>
            </div>
          </div>
          <!-- <script>
            const openBtn_{{$post->id}} = document.getElementById('openBtn_{{$post->id}}');
            const closeBtn_{{$post->id}} = document.getElementById('closeBtn_{{$post->id}}');
            const modal_{{$post->id}} = document.getElementById('modal_{{$post->id}}');
            openBtn_{{$post->id}}.addEventListener('click', () => {
              modal_{{$post->id}}.style.display = 'block';
            })
            closeBtn_{{$post->id}}.addEventListener('click', () => {
              modal_{{$post->id}}.style.display = 'none';
            })
            window.addEventListener('click', (e) => {
              if (!e.target.closest('.modal_inner') && e.target.id !== "openBtn_{{$post->id}}") {
                modal_{{$post->id}}.style.display = 'none';
              }
            });
          </script> -->
          @endif
          @endif
          @endisset
          <!-- 教科表示 -->
          <div class="post_subject">
            @switch($post->subject->id)
            @case(1)
            <style>
              .subject1 {
                color: rgb(240, 119, 139);
                border: 2px solid;
                border-radius: 5px;
                font-size: 13px;
                font-weight: bold;
              }
            </style>
            <span class="subject1">{{$post->subject->subject}}</span>
            @break
            @case(2)
            <style>
              .subject2 {
                color: rgb(87, 170, 252);
                border: 2px solid;
                border-radius: 5px;
                font-size: 13px;
                font-weight: bold;
              }
            </style>
            <span class="subject2">
              {{$post->subject->subject}}
            </span>
            @break
            @case(3)
            <style>
              .subject3 {
                color: purple;
                border: 2px solid;
                border-radius: 5px;
                font-size: 13px;
                font-weight: bold;
              }
            </style>
            <span class="subject3">{{$post->subject->subject}}</span>
            @break
            @case(4)
            <style>
              .subject4 {
                color: green;
                border: 2px solid;
                border-radius: 5px;
                font-size: 13px;
                font-weight: bold;
              }
            </style>
            <span class="subject4">
              {{$post->subject->subject}}
            </span>
            @break
            @case(5)
            <style>
              .subject5 {
                color: orange;
                border: 2px solid;
                border-radius: 5px;
                font-size: 13px;
                font-weight: bold;
              }
            </style>
            <span class="subject5">
              {{$post->subject->subject}}
            </span>
            @break
            @endswitch
          </div>
          <!-- 投稿内容 -->
          <p class="post_text">
            {{$post->text}}
          </p>
          @if(count($post->images) > 0)
          <!-- 画像表示 -->
          <div class="post_images">
            @if($post->images != null)
            @foreach($post->images as $image)
            <img src="{{ asset('/storage/images/'.$image->name) }}">
            @endforeach
            @endif
          </div>
          @endif
        </div>
        <!-- 返信表示 -->
        <div class="reply">
          <div class="reply_create">
            <details class="reply_details">
              @if(count($post->replies) > 0)
              <summary class="reply_summary">
                <span class="summary_span">@php echo count($post->replies) @endphp件の返信</span>
                <p class="summary_p">返信ボタン</p>
              </summary>
              @else
              <summary class="reply_summary2">
                <p class="summary_p">返信ボタン</p>
              </summary>
              @endif
              <div class="but_summary">
                <div class="reply_lists">
                  @foreach($post->replies as $reply)
                  <div class="reply_list">
                    <p class="reply_top">
                      @if($reply->teacher_id != null)
                      {{$reply->teacher->name}}
                      @elseif($reply->user_id != null)
                      {{$reply->user->name}}
                      @endif
                      {{\Carbon\Carbon::parse($reply->created_at)->format("m/d H:i")}}
                    </p>
                    <p class="reply_text">{{$reply->text}}</p>
                  </div>
                  @endforeach
                </div>
                <!-- 返信フォーム -->
                <form action="/reply/create" method="post">
                  @csrf
                  <input type="hidden" name="post_id" value="{{$post->id}}">
                  @if($teacher != null)
                  <input type="hidden" name="teacher_id" value="{{$teacher->id}}">
                  @else($user != null)
                  <input type="hidden" name="user_id" value="{{$user->id}}">
                  @endif
                  <textarea name="text" id="" cols="30" rows="10"></textarea>
                  <input type="submit" value="返信">
                </form>
              </div>
            </details>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </main>
  <!-- 投稿フォーム -->
  <footer class="footer">
    <div class="errors">
      @error('text')
      <p>{{$message}}</p>
      @enderror
      @error('file')
      <p>{{$message}}</p>
      @enderror
    </div>
    <div class="post_create">
      <form action="/post/create" method="post" enctype="multipart/form-data" class="post_form">
        @csrf
        @if($teacher != null)
        <input type="hidden" name="teacher_id" value="{{$teacher->id}}">
        @else($user != null)
        <input type="hidden" name="user_id" value="{{$user->id}}">
        @endif
        <input type="hidden" name="check" value="1">
        <select name="subject_id" class="post_form_subject">
          @foreach($subjects as $subject)
          <option value="{{$subject->id}}">{{$subject->subject}}</option>
          @endforeach
        </select>
        <textarea name="text" id="" cols="30" rows="10" class="post_form_text"></textarea>
        <input type="file" class="post_form_img" id="select_file" accept='image/*' name="file[]" multiple onchange="loadImage(this);">
        <input type="submit" class="post_form_btn" value="投稿">
      </form>
    </div>
    <div id="preview" class="preview">
    </div>
  </footer>
  <style>
  </style>
  <script type="text/javascript" src="/js/home.js">
  </script>
</body>

</html>