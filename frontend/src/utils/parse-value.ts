export default function (str: string | number): number {
  if(typeof str === 'undefined') {
    str = 0
    
    return str;
  }
  
  if (typeof str === 'number') {
    return str;
  }

  const value = str
    .replace(/\./g, '') 
    .replace(/\s/g, '') 
    .replace(',', '.');

  return parseFloat(value);
}
