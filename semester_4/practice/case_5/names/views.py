from django.http import HttpResponse
from django.shortcuts import render, redirect
from .forms import UserForm
from .models import User

def index(request):
    user_id = request.session.get('user_id')
    user = None

    if user_id:
        try:
            user = User.objects.get(pk=user_id)
        except User.DoesNotExist:
            pass

    if request.method == 'POST':
        form = UserForm(request.POST)
        if form.is_valid():
            user = form.save()
            request.session['user_id'] = user.id

            return redirect('index')
    else:
        form = UserForm()

    return render(request, 'index.html', {'form': form, 'user': user})

def logout(request):
    request.session.flush()

    return redirect('index')

