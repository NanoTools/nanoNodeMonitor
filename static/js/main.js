for (i = 0, length = init.length; i < length; i++) {
  try {
    init[i]();
  } catch (e) {
    console.error('Error in init %d', i);
    console.error(e);
  }
}