export default function (dateStr) {
  const date = new Date(dateStr)

  return `${zeroPrefix(date.getDate())}.${zeroPrefix(date.getMonth() + 1)}.${date.getFullYear()} ${zeroPrefix(date.getHours())}:${zeroPrefix(date.getMinutes())}`
}

function zeroPrefix (value) {
  return value < 10 ? '0' + value : value
}
