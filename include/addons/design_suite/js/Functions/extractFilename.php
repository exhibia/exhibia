function extractFilename(path) {
 path = path.replace(')', '');
  if (path.substr(0, 12) == "C:\\fakepath\\")
 
    return path.substr(12); // modern browser
  var x;
  x = path.lastIndexOf('/');
  if (x >= 0) // Unix-based path
 
    return path.substr(x+1);
  x = path.lastIndexOf('\\');
  if (x >= 0) // Windows-based path
    return path.substr(x+1);
    
  return path; // just the filename
}