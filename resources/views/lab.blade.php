@extends('layouts.layoutlab')

@section('content')
<router-view></router-view>
@endsection

<script type="text/javascript">
    window.onbeforeunload = function() {
        return "Your Change May Not Be Saved"
    }
</script>