user = sessionStorage["username"];

mode = {
    none: '',
    create: 'create',
    update: 'update'
}

context = {
    none: {
        id: 'tab-none',
        name: '',
        mainPanel: true
    },
    overview: {
        id: 'overview',
        name: 'Overview',
        mainPanel: true
    },
    warmup: {
        id: 'workout-type-selection',
        name: 'Warmup',
        mainPanel: false
    },
    mainWorkout: {
        id: 'workout-type-selection',
        name: 'Main Workout',
        mainPanel: false
    },
    cooldown: {
        id: 'workout-type-selection',
        name: 'Cooldown',
        mainPanel: false
    }
}

wizard = $('#training-day-wizard');

wizard.id = {
    get: () => {
        return wizard.attr('training-day-id');
    },
    set: (newId) => {
        wizard.attr('training-day-id', newId);
    }
}
wizard.mode = {
    get: () => {
        return wizard.attr('edit-mode');
    },
    set: (newMode) => {
        wizard.attr('edit-mode', newMode);
    }
}
wizard.context = {
    get: () => {
        return wizard.activeContext;
    },
    set: (newContext) => {
        wizard.activeContext = newContext;
        wizard.attr('edit-context', newContext.id);
        $('#training-day-subtype').text(newContext.name);
        wizard.find('.active').removeClass('active');
        wizard.find(('#' + newContext.id)).addClass('active');
        if(newContext.mainPanel) {
            $('#main-control').removeClass('d-none');
            $('#sub-control').addClass('d-none');
        } else {
            $('#main-control').addClass('d-none');
            $('#sub-control').removeClass('d-none');
        }
    }
}
wizard.trainingDay = {
    get: () => {
        return wizard.attr('training-day');
    },
    set: (newTrainingDay) => {
        wizard.attr('training-day', newTrainingDay);
    }
}
wizard.workoutType = {
    get: () => {
        return $('.workout-type.active').attr('id');
    },
    set: (workoutType) => {
        wizard.find('.active').removeClass('active');
        $('.workout-type.active').removeClass('active');
        $('#' + workoutType).addClass('active');
    }
}
wizard.newTraining = () => {
    wizard.mode.set(mode.create);
    wizard.trainingDay.set((routines.lastDay() + 1));
    wizard.context.set(context.overview);
    api.createTraining(user, wizard.trainingDay.get(), function(response) {
        wizard.id.set(response.id);
    });
}
wizard.clear = () => {
    wizard.context.set(context.none);
    wizard.mode.set(mode.none);
    wizard.trainingDay.set('');
    wizard.id.set('');
}
wizard.clearWorkout = (workoutType) => {

}
wizard.save = () => {
    wizard.clear();
}
wizard.cancel = () => {
    if(wizard.mode.get() === mode.create) {
        api.deleteTraining(wizard.id.get());
    }
    wizard.clear();
}
wizard.on('hide.bs.modal', function() {
    wizard.cancel();
});
