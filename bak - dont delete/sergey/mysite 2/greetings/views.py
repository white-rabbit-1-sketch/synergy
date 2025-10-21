from django.shortcuts import render, redirect
from .forms import UserForm
from .models import User

def index(request):
    if request.method == 'POST':
        return handle_post_request(request)
    else:
        return handle_get_request(request)

def handle_post_request(request):
    form = None
    user = None
    user_id = request.session.get('user_id')

    if user_id:
        try:
            user = User.objects.get(pk=user_id)
        except User.DoesNotExist:
            pass

    form = UserForm(request.POST)
    if form.is_valid():
        user = form.save()
        request.session['user_id'] = user.id
        return redirect('index')

    return render(request, 'greetings.html', {'form': form, 'user': user})

def handle_get_request(request):
    form = UserForm()
    user_id = request.session.get('user_id')

    if user_id:
        try:
            user = User.objects.get(pk=user_id)
        except User.DoesNotExist:
            user = None
    else:
        user = None

    return render(request, 'greetings.html', {'form': form, 'user': user})