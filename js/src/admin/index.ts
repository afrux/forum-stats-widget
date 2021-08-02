import registerWidget from '../common/registerWidget';

app.initializers.add('afrux/forum-stats-widget', () => {
  registerWidget(app);
});
